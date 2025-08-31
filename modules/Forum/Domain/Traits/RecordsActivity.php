<?php

namespace Modules\Forum\Domain\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Modules\Forum\Domain\Models\Activity;
use ReflectionClass;

trait RecordsActivity
{
    protected static function bootRecordsActivity(): void
    {
        if (!auth()->guest()) {
            foreach (static::getActivitiesToRecord() as $event) {
                static::$event(static function (Model $model) use ($event) {
                    $model->recordActivity($event);
                });
            }
        }

        static::deleting(static function (Model $model) {
            $model->activities()->delete();
        });
    }

    protected static function getActivitiesToRecord(): array
    {
        return ['created'];
    }

    protected function recordActivity(string $event): void
    {
        $this->activities()->create([
            'user_id' => auth()->id(),
            'type' => $this->getActivityEvent($event),
        ]);
    }

    public function activities(): MorphMany
    {
        return $this->morphMany(Activity::class, 'subject');
    }

    protected function getActivityEvent(string $event): string
    {
        $type = strtolower(new ReflectionClass($this)->getShortName());
        return $event . '_' . $type;
    }
}
