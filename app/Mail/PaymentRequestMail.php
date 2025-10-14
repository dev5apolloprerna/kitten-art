<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $parentName;
    public $amount;
    public $website;
    public $fromEmail;
    public $fromName;

    public function __construct($parentName, $amount, $website, $fromEmail, $fromName)
    {
        $this->parentName = $parentName;
        $this->amount = $amount;
        $this->website = $website;
        $this->fromEmail = $fromEmail;
        $this->fromName = $fromName;
    }

    public function build()
    {
        // Load email template from public folder
        $fileContent = file_get_contents(public_path('mailers/adminmail.html'));

        // Replace placeholders with actual values
        $fileContent = str_replace('#parent_name', $this->parentName, $fileContent);
        $fileContent = str_replace('#amount', $this->amount, $fileContent);
        $fileContent = str_replace('#website', $this->website, $fileContent);

        return $this->from($this->fromEmail, $this->fromName)
                    ->subject('Thank You For Your Registration')
                    ->html($fileContent); // Use 'html()' to send raw HTML content
    }
}

?>