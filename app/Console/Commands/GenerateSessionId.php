<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\customer_session;
use Webpatser\Uuid\Uuid;

class GenerateSessionId extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'session:generate {customer_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a session ID for a customer for testing purposes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $customer_id = $this->argument('customer_id');
        
        // Generate new session ID
        $session_id = Uuid::generate()->string;
        
        // Create session in database
        $customer_session = new customer_session();
        $customer_session->customer_id = $customer_id;
        $customer_session->session_id = $session_id;
        $customer_session->soft_delete = 0;
        $customer_session->save();
        
        $this->info("Session ID generated successfully!");
        $this->line("Customer ID: {$customer_id}");
        $this->line("Session ID: {$session_id}");
        $this->line("");
        $this->info("Use this in Postman:");
        $this->line("customer_id: {$customer_id}");
        $this->line("session_id: {$session_id}");
        $this->line("main_brand_id: 1");
        $this->line("language_id: 1");
        
        return 0;
    }
}

