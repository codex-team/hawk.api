<?php

declare(strict_types=1);

namespace App\Components\Base;

use Mailgun\Mailgun;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

/**
 * Class Mail
 */
class Mail
{
    /** @var  Mailgun */
    private static $mg;
    /** @var PHPMailer */
    private static $mailer;

    /**
     * Send email
     *
     * @param string $email
     * @param string $subject
     * @param string $template
     * @param array  $variables
     *
     * @return bool
     */
    public static function sendViaMailgun(string $email, string $subject, string $template, array $variables = []): bool
    {
        $render = Twig::renderTwigTemplate($template, $variables);
        $mg = self::getMailgunInstance();

        $mg->messages()->send(Configs::get('mailgun')['domain'], [
                'from' => Configs::get('mailgun')['from'],
                'to' => $email,
                'subject' => $subject,
                'html' => $render
            ]
        );

        return true;
    }

    /**
     * Create and get Mailgun instance
     *
     * @return Mailgun
     */
    private static function getMailgunInstance(): Mailgun
    {
        if (!isset(self::$mg)) {
            self::$mg = Mailgun::create(Configs::get('mailgun')['key']);
        }

        return self::$mg;
    }

    /**
     * Send email
     *
     * @param string $email
     * @param string $subject
     * @param string $template
     * @param array $variables
     *
     * @throws Exception
     *
     * @return bool
     */
    public static function sendViaSMTP(string $email, string $subject, string $template, array $variables = []): bool
    {
        $render = Twig::renderTwigTemplate($template, $variables);
        $mailer = self::getMailerInstance();

        $mailer->setFrom(Configs::get('smtp')['username'], 'HAWK');
        $mailer->addAddress($email, 'User >:|');

        $mailer->isHTML();
        $mailer->Subject = $subject;
        $mailer->Body = $render;

        return $mailer->send();
    }

    /**
     * Create and get Mailgun instance
     *
     * @return PHPMailer
     */
    private static function getMailerInstance(): PHPMailer
    {
        if (!isset(self::$mailer)) {
            $mailer = new PHPMailer(true);
            $mailer->isSMTP();
            $mailer->Host = Configs::get('smtp')['host'];
            $mailer->SMTPAuth = true;
            $mailer->Username = Configs::get('smtp')['username'];
            $mailer->Password = Configs::get('smtp')['password'];
            $mailer->SMTPSecure = 'tls';
            $mailer->Port = 587;
            $mailer->CharSet = 'UTF-8';
            self::$mailer = $mailer;
        }

        return self::$mailer;
    }
}
