<?php
declare(strict_types=1);

namespace App\Mailer;

use Cake\Mailer\Mailer;

/**
 * Users mailer.
 */
class UsersMailer extends Mailer
{
    /**
     * Mailer's name.
     *
     * @var string
     */
    public static string $name = 'Users';

    /**
     * Send account activation email to the user.
     *
     * @param array $user The user data to include in the email.
     * @param string $activationLink The activation link to include in the email.
     * @return void
     */

    public function sendActivationEmail(array $user, string $activationLink): void
    {
        $this->viewBuilder()
            ->setTemplate('activate_account'); // Use the appropriate email template

        $this
            ->setTo($user['email'])
            ->setFrom('noreply@yourapp.com')
            ->setSubject('Activate Your Account')
            ->setViewVars(['user' => $user, 'activationLink' => $activationLink]) // Pass user data and activation link to the template
            ->setEmailFormat('both') // Send email in both HTML and text formats
            ->send();
    }
}
