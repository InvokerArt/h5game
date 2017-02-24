<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\Store;
use Auth;

/**
 * Class SessionTimeout.
 */
class SessionTimeout
{
    /**
     * @var Store
     */
    protected $session;

    /**
     * @var mixed
     */
    protected $timeout;

    /**
     * @param Store $session
     */
    public function __construct(Store $session)
    {
        $this->session = $session;
        $this->timeout = config('misc.session_timeout');
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'admin')
    {
        if (config('misc.session_timeout_status')) {
            $isLoggedIn = $request->path() != '/logout';

            if (!session('lastActivityTime')) {
                $this->session->put('lastActivityTime', time());
            } elseif (time() - $this->session->get('lastActivityTime') > $this->timeout) {
                $this->session->forget('lastActivityTime');
                $cookie = cookie('intend', $isLoggedIn ? url()->current() : 'backend/dashboard');
                $mobile = Auth::guard($guard)->user()->mobile;
                access()->logout();

                return redirect()->route('backend.auth.login')->withFlashWarning('由于您在' . $this->timeout / 60 . '分钟内没有活动，因此出于安全考虑，系统会自动退出。')->withInput(compact('mobile'))->withCookie($cookie);
            }

            $isLoggedIn ? $this->session->put('lastActivityTime', time()) : $this->session->forget('lastActivityTime');
        }

        return $next($request);
    }
}
