<?php

use App\User\Models\User;
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
        Schema::create('availability_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user_id')->index()->nullable();
            $table->string('contact_data', 255);
            $table->string('comment')->nullable();
            $table->timestamp('date_from');
            $table->timestamp('date_to')->nullable();
            $table->string('state', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('availability_requests');
    }
};
