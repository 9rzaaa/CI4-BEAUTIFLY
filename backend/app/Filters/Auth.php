<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface
{
    /**
     * Runs before controller execution.
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Check if user session exists
        if (! $session->has('user') || empty($session->get('user')['id'])) {
            // Optional: Save current URL to redirect after login
            $session->set('redirect_url', current_url());

            return redirect()->to('/login');
        }
    }

    /**
     * Runs after controller execution.
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Nothing to do here
    }
}
