<?php

namespace App\Domains\Http\Jobs;

use App\Foundation\Job;
use Illuminate\Routing\ResponseFactory;

class RespondWithJsonJob extends Job
{
    private $status;
    private $content;
    private $headers;
    private $options;

    public function __construct($content, $status = 200, array $headers = [], $options = 0)
    {
        $this->content = $content;
        $this->status = $status;
        $this->headers = $headers;
        $this->options = $options;
    }

    public function handle(ResponseFactory $response)
    {
        $response = [
            'data' => $this->content,
            'status' => $this->status,
        ];

        return $response->json($response, $this->status, $this->headers, $this->options);
    }
}
