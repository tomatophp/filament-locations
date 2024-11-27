<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn('lat');
            $table->dropColumn('lang');
        });

        Schema::table('countries', function (Blueprint $table) {
            $table->index('name');
            $table->json('translations')->nullable();
            $table->json('timezones')->nullable();
            $table->char('numeric_code', 3)->nullable();
            $table->char('iso3', 3)->nullable();
            $table->string('nationality')->nullable();
            $table->string('capital')->nullable();
            $table->string('tld')->nullable();
            $table->string('native')->nullable();
            $table->string('region')->nullable();
            $table->string('currency')->nullable();
            $table->string('currency_name')->nullable();
            $table->string('currency_symbol')->nullable();
            $table->string('wikiDataId')->nullable();

            $table->decimal('lat')->nullable();
            $table->decimal('lng')->nullable();

            $table->string('emoji')->nullable();
            $table->string('emojiU')->nullable();
            $table->boolean('flag')->default(0)->nullable();

            $table->boolean('is_activated')->default(1)->nullable();
        });

        Schema::table('cities', function (Blueprint $table) {
            $table->dropColumn('lat');
            $table->dropColumn('lang');
            $table->dropColumn('price');
            $table->dropColumn('shipping');
        });

        Schema::table('cities', function (Blueprint $table) {
            $table->index('name');
            $table->json('translations')->nullable();
            $table->string('timezone')->nullable();

            $table->decimal('lat')->nullable();
            $table->decimal('lng')->nullable();

            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');

            $table->boolean('is_activated')->default(1)->nullable();
        });

        Schema::table('areas', function (Blueprint $table) {
            $table->dropColumn('lat');
            $table->dropColumn('lang');
        });

        Schema::table('areas', function (Blueprint $table) {
            $table->index('name');

            $table->json('translations')->nullable();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->boolean('is_activated')->default(1)->nullable();
        });

        Schema::table('currencies', function (Blueprint $table) {
            $table->index('name');

            $table->double('exchange_rate')->nullable();
            $table->string('symbol')->nullable();

            $table->json('translations')->nullable();

            $table->boolean('is_activated')->default(1)->nullable();
        });

        Schema::table('languages', function (Blueprint $table) {
            $table->index('name');
            $table->json('translations')->nullable();

            $table->boolean('is_activated')->default(1)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->string('lat');
            $table->string('lang');

            $table->dropColumn('translations');
            $table->dropColumn('timezones');
            $table->dropColumn('numeric_code', 3);
            $table->dropColumn('iso3', 3);
            $table->dropColumn('nationality');
            $table->dropColumn('capital');
            $table->dropColumn('tld');
            $table->dropColumn('native');
            $table->dropColumn('region');
            $table->dropColumn('currency');
            $table->dropColumn('currency_name');
            $table->dropColumn('currency_symbol');
            $table->dropColumn('wikiDataId');
            $table->dropColumn('lat');
            $table->dropColumn('lng');
            $table->dropColumn('emoji');
            $table->dropColumn('emojiU');
            $table->dropColumn('flag');
            $table->dropColumn('is_activated');
        });

        Schema::table('cities', function (Blueprint $table) {
            $table->string('lat');
            $table->string('lang');
            $table->double('price');
            $table->longText('shipping');

            $table->dropColumn('translations');
            $table->dropColumn('timezone');
            $table->dropColumn('lat');
            $table->dropColumn('lng');
            $table->dropColumn('is_activated');
            $table->dropForeign('country_id');
        });

        Schema::table('areas', function (Blueprint $table) {
            $table->string('lat');
            $table->string('lang');

            $table->dropColumn('translations');
            $table->dropColumn('is_activated');
            $table->dropForeign('city_id');

        });

        Schema::table('currencies', function (Blueprint $table) {
            $table->dropColumn('exchange_rate');
            $table->dropColumn('symbol');
            $table->dropColumn('translations');
            $table->dropColumn('is_activated');
        });

        Schema::table('languages', function (Blueprint $table) {
            $table->dropColumn('translations');
            $table->dropColumn('is_activated');
        });
    }
};
