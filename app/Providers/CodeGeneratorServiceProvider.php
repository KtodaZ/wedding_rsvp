<?php namespace App\Providers;


use App\Contracts\Generators\CodeGenerator;
use App\Utility\Generators\RsvpCodeGenerator;
use Illuminate\Support\ServiceProvider;

class CodeGeneratorServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CodeGenerator::class, function () {
            $phrasesFile = \File::get(storage_path('wed/wed_phrases.txt'));

            $phrases = explode(',', $phrasesFile);

            return new RsvpCodeGenerator($phrases);
        });
    }

}