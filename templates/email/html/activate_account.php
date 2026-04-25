<p>Hello <?= h($user['email']) ?>,</p>

<p>Please activate your account using the link below:</p>

<p>
    <a href="<?= h($activationLink) ?>">
        Activate account
    </a>

<p>If you did not create an account, please ignore this email.</p>
<p>Thank you,</p>
<p>Your App Team</p>

<hr>
<p>This is an automated message, please do not reply.</p>
<p>If you have any issues, please contact support.</p>
</p>