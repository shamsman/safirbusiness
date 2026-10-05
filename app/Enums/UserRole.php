<?php

namespace App\Enums;

enum UserRole: string
{
    case Superadmin = 'superadmin';
    case Admin      = 'admin';
    case Editor     = 'editor';
    case Guest      = 'guest';

    public function label(): string
    {
        return match ($this) {
            self::Superadmin => 'Superadmin',
            self::Admin      => 'Admin',
            self::Editor     => 'Editor',
            self::Guest      => 'Guest',
        };
    }

    /**
     * Role hierarchy level.
     */
    public function level(): int
    {
        return match ($this) {
            self::Superadmin => 40,
            self::Admin      => 30,
            self::Editor     => 20,
            self::Guest      => 10,
        };
    }

    public function atLeast(self $role): bool
    {
        return $this->level() >= $role->level();
    }

    /**
     * Whether this role can manage (edit/delete) a target role.
     */
    public function canManage(self $target): bool
    {
        return $this->level() > $target->level();
    }

    /**
     * Roles this actor is authorized to assign.
     */
    public function assignable(): array
    {
        return match ($this) {
            self::Superadmin => [self::Superadmin, self::Admin, self::Editor, self::Guest],
            self::Admin      => [self::Admin, self::Editor, self::Guest],
            self::Editor     => [self::Guest],
            self::Guest      => [],
        };
    }

    public function badgeClasses(): string
    {
        return match ($this) {
            self::Superadmin => 'bg-amber-100 text-amber-900 border border-amber-300 font-semibold',
            self::Admin      => 'bg-blue-100 text-blue-900 border border-blue-300 font-semibold',
            self::Editor     => 'bg-emerald-100 text-emerald-900 border border-emerald-300 font-semibold',
            self::Guest      => 'bg-slate-100 text-slate-800 border border-slate-300 font-semibold',
        };
    }

    public static function options(): array
    {
        return array_map(
            fn (self $role) => ['value' => $role->value, 'label' => $role->label()],
            self::cases()
        );
    }
}
