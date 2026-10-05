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
            self::Superadmin => 'bg-amber-500/15 text-amber-300 border border-amber-500/30',
            self::Admin      => 'bg-blue-500/15 text-blue-300 border border-blue-500/30',
            self::Editor     => 'bg-emerald-500/15 text-emerald-300 border border-emerald-500/30',
            self::Guest      => 'bg-slate-500/15 text-slate-300 border border-slate-500/30',
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
