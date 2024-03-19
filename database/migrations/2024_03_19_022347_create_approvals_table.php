<?php

use App\Models\approvers;
use App\Models\expenses;
use App\Models\statuses;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApprovalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approvals', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(expenses::class, 'expense_id');
            $table->foreignIdFor(approvers::class, 'approver_id');
            $table->foreignIdFor(statuses::class, 'status_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('approvals');
    }
}
