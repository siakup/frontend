<?php

namespace App\Helpers\Components;

use Illuminate\View\ComponentAttributeBag;

class Utilities
{
    public static function resolve(ComponentAttributeBag $attributes): array
    {
        $classes = [];

        /* ========== GRID ========== */
        if ($attributes->get('rows') !== null || $attributes->get('cols') !== null) {
            $classes[] = 'grid';
        }

        $classes = array_merge(
            $classes,
            self::mapNumeric($attributes, [
                'rows' => 'grid-rows-%s',
                'cols' => 'grid-cols-%s',
            ])
        );

        /* ========== GAP ========== */
        $classes = array_merge(
            $classes,
            self::mapNumeric($attributes, [
                'gap' => 'gap-%s',
                'gapX' => 'gap-x-%s',
                'gapY' => 'gap-y-%s',
            ])
        );

        /* ========== PADDING ========== */
        $classes = array_merge(
            $classes,
            self::mapNumeric($attributes, [
                'padding' => 'p-%s',
                'px' => 'px-%s',
                'py' => 'py-%s',
                'pt' => 'pt-%s',
                'pb' => 'pb-%s',
                'pl' => 'pl-%s',
                'pr' => 'pr-%s',
            ])
        );

        /* ========== MARGIN ========== */
        $classes = array_merge(
            $classes,
            self::mapNumeric($attributes, [
                'margin' => 'm-%s',
                'mx' => 'mx-%s',
                'my' => 'my-%s',
                'mt' => 'mt-%s',
                'mb' => 'mb-%s',
                'ml' => 'ml-%s',
                'mr' => 'mr-%s',
            ])
        );

        /* ========== SHADOW ========== */
        if ($shadow = self::mapShadow($attributes)) {
            $classes[] = $shadow;
        }

        /* ========== RADIUS ========== */
        if ($radius = self::mapRadius($attributes)) {
            $classes[] = $radius;
        }

        /* ========== BORDER ========== */
        if ($border = self::mapBorder($attributes)) {
            array_push($classes, ...$border);
        }

        return $classes;
    }

    /* ============================================================
     | NUMERIC HANDLER (SUPPORT: 2.5, 2_5, 2,5)
     * ============================================================ */
    protected static function mapNumeric(
        ComponentAttributeBag $attributes,
        array $map,
        float $max = 12
    ): array {
        $classes = [];

        foreach ($map as $attr => $pattern) {
            $raw = $attributes->get($attr);

            if ($raw === null) {
                continue;
            }

            /**
             * STEP 1:
             * Normalisasi input:
             * 2,5 → 2.5
             * 2_5 → 2.5
             */
            $normalized = str_replace([',', '_'], '.', (string) $raw);

            /**
             * STEP 2:
             * Validasi numeric murni
             */
            if (!is_numeric($normalized)) {
                continue;
            }

            $numeric = (float) $normalized;

            if ($numeric < 0 || $numeric > $max) {
                continue;
            }

            /**
             * STEP 3:
             * Convert ke format class Tailwind-safe
             * 2.5 → 2_5
             */
            // $classValue = str_replace('.', '_', (string) $numeric);

            $classes[] = sprintf($pattern, $numeric);
        }

        return $classes;
    }

    /* ========== SHADOW ========== */
    protected static function mapShadow(ComponentAttributeBag $attributes): ?string
    {
        return match ($attributes->get('shadow')) {
            'low' => 'shadow-low',
            'medium' => 'shadow-medium',
            'high' => 'shadow-high',
            'low-inverse' => 'shadow-low-inverse',
            'medium-inverse' => 'shadow-medium-inverse',
            'high-inverse' => 'shadow-high-inverse',
            default => null,
        };
    }

    /* ========== RADIUS ========== */
    protected static function mapRadius(ComponentAttributeBag $attributes): ?string
    {
        return match ($attributes->get('radius')) {
            'none' => 'rounded-none',
            'xs' => 'rounded-xs',
            'sm' => 'rounded-sm',
            'md' => 'rounded-md',
            'lg' => 'rounded-lg',
            default => null,
        };
    }

    /* ========== BORDER ========== */
    protected static function mapBorder(ComponentAttributeBag $attributes): ?array
    {
        if ($attributes->get('border') === null) {
            return null;
        }

        $classes = ['border'];

        $style = match ($attributes->get('border')) {
            'solid' => 'border-solid',
            'dashed' => 'border-dashed',
            'dotted' => 'border-dotted',
            'double' => 'border-double',
            'none' => 'border-none',
            default => null,
        };

        if ($style) {
            $classes[] = $style;
        }

        if ($color = self::mapBorderColor($attributes->get('borderColor'))) {
            $classes[] = $color;
        }

        if ($width = $attributes->get('borderWidth')) {
            $width = (int) $width;
            if ($width >= 0 && $width <= 8) {
                $classes[] = 'border-' . $width;
            }
        }

        return $classes;
    }

    protected static function mapBorderColor(?string $color): ?string
    {
        return match ($color) {
            // RED
            'red-50' => 'border-red-50',
            'red-100' => 'border-red-100',
            'red-200' => 'border-red-200',
            'red-300' => 'border-red-300',
            'red-400' => 'border-red-400',
            'red-500' => 'border-red-500',
            'red-600' => 'border-red-600',
            'red-700' => 'border-red-700',
            'red-800' => 'border-red-800',
            'red-900' => 'border-red-900',

            // GREEN
            'green-50' => 'border-green-50',
            'green-100' => 'border-green-100',
            'green-200' => 'border-green-200',
            'green-300' => 'border-green-300',
            'green-400' => 'border-green-400',
            'green-500' => 'border-green-500',
            'green-600' => 'border-green-600',
            'green-700' => 'border-green-700',
            'green-800' => 'border-green-800',
            'green-900' => 'border-green-900',

            // BLUE
            'blue-50' => 'border-blue-50',
            'blue-100' => 'border-blue-100',
            'blue-200' => 'border-blue-200',
            'blue-300' => 'border-blue-300',
            'blue-400' => 'border-blue-400',
            'blue-500' => 'border-blue-500',
            'blue-600' => 'border-blue-600',
            'blue-700' => 'border-blue-700',
            'blue-800' => 'border-blue-800',
            'blue-900' => 'border-blue-900',

            // Beaver
            'beaver-50' => 'border-beaver-50',
            'beaver-100' => 'border-beaver-100',
            'beaver-200' => 'border-beaver-200',
            'beaver-300' => 'border-beaver-300',
            'beaver-400' => 'border-beaver-400',
            'beaver-500' => 'border-beaver-500',
            'beaver-600' => 'border-beaver-600',
            'beaver-700' => 'border-beaver-700',
            'beaver-800' => 'border-beaver-800',
            'beaver-900' => 'border-beaver-900',

            // GRAY
            'gray-100' => 'border-gray-100',
            'gray-200' => 'border-gray-200',
            'gray-300' => 'border-gray-300',
            'gray-400' => 'border-gray-400',
            'gray-500' => 'border-gray-500',
            'gray-600' => 'border-gray-600',
            'gray-700' => 'border-gray-700',
            'gray-800' => 'border-gray-800',
            'gray-900' => 'border-gray-900',

            default => null,
        };
    }
}