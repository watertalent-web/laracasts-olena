<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Idea;
use Illuminate\Support\Facades\DB;

class UpdateIdea
{
    public function handle(array $attributes, Idea $idea): void
    {

        $data = collect($attributes)->only([
            'title',
            'description',
            'status',
            'links',
        ])->toArray();

        if (isset($attributes['image'])) {
            $data['image_path'] = $attributes['image']->store('ideas', 'public');
        }

        DB::transaction(function () use ($idea, $data, $attributes) {
            $idea->update($data);

            $idea->steps()->delete();

            $steps = collect($attributes['steps'] ?? [])->map(function ($step): array {
                if (is_array($step)) {
                    return [
                        'description' => $step['description'] ?? '',
                        'completed' => filter_var($step['completed'] ?? false, FILTER_VALIDATE_BOOLEAN),
                    ];
                }

                return ['description' => $step, 'completed' => false];
            });

            $idea->steps()->createMany($steps);
        });
    }
}
