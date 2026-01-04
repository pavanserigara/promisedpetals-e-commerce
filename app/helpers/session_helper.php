<?php
session_start();

// Flash message helper
function flash($name = '', $message = '', $class = 'bg-green-100 border border-green-200 text-green-800')
{
    if (!empty($name)) {
        if (!empty($message) && empty($_SESSION[$name])) {
            if (!empty($_SESSION[$name . '_class'])) {
                unset($_SESSION[$name . '_class']);
            }
            $_SESSION[$name] = $message;
            $_SESSION[$name . '_class'] = $class;
        } elseif (empty($message) && !empty($_SESSION[$name])) {
            $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
            echo '<div class="' . $class . ' px-4 py-3 rounded-xl mb-6 shadow-sm flex items-center gap-3 animate-up" role="alert">
                    <span class="text-xl">✨</span>
                    <span class="font-medium">' . $_SESSION[$name] . '</span>
                  </div>';
            unset($_SESSION[$name]);
            unset($_SESSION[$name . '_class']);
        }
    }
}

// Security: Session Activity Check
function checkSessionTimeout()
{
    $timeout = 1800; // 30 minutes
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout)) {
        session_unset();
        session_destroy();
        return false;
    }
    $_SESSION['last_activity'] = time();
    return true;
}

function isLoggedIn()
{
    if (isset($_SESSION['user_id'])) {
        return true;
    } else {
        return false;
    }
}

function isAdmin()
{
    if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
        return true;
    } else {
        return false;
    }
}

// Security: CSRF Protection
function generateCsrfToken()
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_field()
{
    echo '<input type="hidden" name="csrf_token" value="' . generateCsrfToken() . '">';
}

function validateCsrfToken($token)
{
    if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
        return false;
    }
    return true;
}

/**
 * Basic Rate Limiting using Session
 * @param string $key Unique key for the action (e.g. 'login_attempt')
 * @param int $limit Max attempts
 * @param int $window Time window in seconds
 * @return bool True if allowed, false if limited
 */
function checkRateLimit($key, $limit = 5, $window = 60)
{
    if (!isset($_SESSION['rate_limits'])) {
        $_SESSION['rate_limits'] = [];
    }

    if (!isset($_SESSION['rate_limits'][$key])) {
        $_SESSION['rate_limits'][$key] = [];
    }

    $now = time();
    // Clear old attempts
    $_SESSION['rate_limits'][$key] = array_filter($_SESSION['rate_limits'][$key], function ($timestamp) use ($now, $window) {
        return $timestamp > ($now - $window);
    });

    if (count($_SESSION['rate_limits'][$key]) >= $limit) {
        return false;
    }

    $_SESSION['rate_limits'][$key][] = $now;
    return true;
}
