<?php

namespace App\Helpers\Components;

use Illuminate\View\ComponentAttributeBag;

class Utilities
{
    public static function resolve(ComponentAttributeBag $attributes): array
    {
        $classes = [];

        /* ========== GRID ========== */
        if ($attributes->hasAny(['rows', 'cols'])) {
            $classes[] = 'grid';
        }

        $classes = array_merge($classes, self::mapNumeric($attributes, [
            'rows' => 'grid-rows-%d',
            'cols' => 'grid-cols-%d',
        ]));

        /* ========== GAP ========== */
        $classes = array_merge($classes, self::mapNumeric($attributes, [
            'gap' => 'gap-%d',
            'gapX' => 'gap-x-%d',
            'gapY' => 'gap-y-%d',
        ]));

        /* ========== PADDING ========== */
        $classes = array_merge($classes, self::mapNumeric($attributes, [
            'padding' => 'p-%d',
            'px' => 'px-%d',
            'py' => 'py-%d',
            'pt' => 'pt-%d',
            'pb' => 'pb-%d',
            'pl' => 'pl-%d',
            'pr' => 'pr-%d',
        ]));

        /* ========== MARGIN ========== */
        $classes = array_merge($classes, self::mapNumeric($attributes, [
            'margin' => 'm-%d',
            'mx' => 'mx-%d',
            'my' => 'my-%d',
            'mt' => 'mt-%d',
            'mb' => 'mb-%d',
            'ml' => 'ml-%d',
            'mr' => 'mr-%d',
        ]));

        /* ========== SPACE ========== */
        $classes = array_merge($classes, self::mapNumeric($attributes, [
            'spaceX' => 'space-x-%d',
            'spaceY' => 'space-y-%d',
        ]));

        /* ========== SHADOW ========== */
        $classes[] = self::mapEnum($attributes, 'shadow', [
            'low' => 'shadow-low',
            'medium' => 'shadow-medium',
            'high' => 'shadow-high',
            'low-inverse' => 'shadow-low-inverse',
            'medium-inverse' => 'shadow-medium-inverse',
            'high-inverse' => 'shadow-high-inverse',
        ]);

        /* ========== RADIUS ========== */
        $classes[] = self::mapEnum($attributes, 'radius', [
            'none' => 'rounded-none',
            'xs' => 'rounded-xs',
            'sm' => 'rounded-sm',
            'md' => 'rounded-md',
            'lg' => 'rounded-lg',
        ]);

        /* ========== BORDER ========== */
        if ($attributes->has('border')) {
            $classes[] = 'border';

            $classes[] = self::mapEnum($attributes, 'border', [
                'solid' => 'border-solid',
                'dashed' => 'border-dashed',
                'dotted' => 'border-dotted',
                'double' => 'border-double',
                'none' => 'border-none',
            ]);
        }

        if ($attributes->has('borderColor')) {
            $classes[] = 'border-' . $attributes->get('borderColor');
        }

        $classes = array_merge($classes, self::mapNumeric($attributes, [
            'borderWidth' => 'border-%d',
        ]));

        return array_filter($classes);
    }

    /* ========== HELPERS ========== */

    protected static function mapNumeric(
        ComponentAttributeBag $attributes,
        array $map,
        int $max = 16
    ): array {
        $classes = [];

        foreach ($map as $attr => $pattern) {
            if (!$attributes->has($attr)) {
                continue;
            }

            $value = (int) $attributes->get($attr);

            if ($value >= 0 && $value <= $max) {
                $classes[] = sprintf($pattern, $value);
            }
        }

        return $classes;
    }

    protected static function mapEnum(
        ComponentAttributeBag $attributes,
        string $attr,
        array $map
    ): ?string {
        if (!$attributes->has($attr)) {
            return null;
        }

        return $map[$attributes->get($attr)] ?? null;
    }
}