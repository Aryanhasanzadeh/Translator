<?php

namespace Aryanhasanzadeh\Translator\App\Jobs;

use Aryanhasanzadeh\Translator\Helper\SingleTon\GetTranslator;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DoTranslateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;
    use SerializesModels;

    protected string $target='';
    protected string $text='';
    protected string $type='';
    protected $TranslateManager;
    protected Model $parent;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $target,string $text,string $type,Model $parent)
    {
        
        $this->target=$target;
        $this->text=$text;
        $this->type=$type;
        $this->parent=$parent;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->TranslateManager = GetTranslator::getInstance(config('Translator.active_server'));

        $this->parent->translate()->updateOrCreate(
            [
                'lang'=>$this->target,
                'type'=>$this->type,
                'data'=>$this->TranslateManager->setTarget($this->target)->getTranslate($this->text)
            ]
        );
    }
}
