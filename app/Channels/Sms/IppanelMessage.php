<?php


namespace App\Channels\Sms;


use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class IppanelMessage
{


    protected string $key;
    protected string $to;
    protected string $from;
    protected string $patternCode = '';
    protected array $patternValue = [];
    public $response;
    protected array $lines;
    protected string $smsPathSend;
    protected array $parameters = [];

    /**
     * SmsMessage constructor.
     * @param array $lines
     */
    public function __construct($lines = [])
    {
        $this->lines = $lines;

        // Pull in config from the config/services.php file.
        $this->from = config('sms.ippanel.from');
        $this->baseUrl = config('sms.ippanel.base_url');
        $this->key = config('sms.ippanel.AccessKey');
    }

    public function line($line = ''): self
    {
        $this->lines[] = $line;

        return $this;
    }

    public function to($to): self
    {
        $this->to = $to;

        return $this;
    }

    public function from($from): self
    {
        $this->from = $from;

        return $this;
    }

    public function patternCode($patternCode): self
    {
        $this->patternCode = $patternCode;

        return $this;
    }
    public function patternValue(array $patternValue): self
    {
        $this->patternValue = $patternValue;

        return $this;
    }

    public function send(): mixed
    {
        if (!$this->from || !$this->to) {
            throw new \Exception('SMS not correct.');
        }


        if ($this->patternCode) {
            $this->patternSend();
        } else {
            $this->simpleSend();
        }

        $response =  Http::baseUrl($this->baseUrl)->withToken($this->key, 'AccessKey')
            ->post($this->smsPathSend, $this->parameters);

         if ($response->failed() || $response->json('status') != 'OK' ) {
            
            return $response->throw() ;
        }
        $this->response = $response->json();
        return $this;
    }


    function patternSend()
    {
        if (empty($this->patternValue)) {
            throw new \Exception('please set pattern value.');
        }
        $this->smsPathSend = "/messages/patterns/send";
        $this->parameters = [
            'originator' => $this->from,
            'recipient' => $this->to,
            'pattern_code' => $this->patternCode,
            'values' => $this->patternValue,
        ];
    }

    function simpleSend()
    {
        if (empty($this->lines)) {
            throw new \Exception('please set sms text.');
        }
        $this->smsPathSend = "/messages";
        $this->parameters = [
            'originator' => $this->from,
            'recipients' => collect($this->to)->all(),
            'message' => collect($this->lines)->join("\n"),
        ];
    }
    public function dryrun($dry = 'yes'): self
    {
        $this->dryrun = $dry;

        return $this;
    }
}
