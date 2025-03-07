<?php

use App\MailSendStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('email_sending_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subscriber_id')->constrained('subscribed_users')->cascadeOnDelete();
            $table->foreignId('blog_post_id')->constrained()->cascadeOnDelete();
            $table->enum('status', [MailSendStatus::DRAFT->value, MailSendStatus::SENT->value])->default(MailSendStatus::DRAFT->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_sending_statuses');
    }
};
