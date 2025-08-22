<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Barber;
use App\Models\Service;
use App\Models\Customer;
use App\Models\WorkingHour;
use App\Models\Plan;
use App\Models\PlanBenefit;

class BaseSeed extends Seeder
{
    public function run(): void
    {
        // ── Usuários base ─────────────────────────────────────────────
        $admin = User::firstOrCreate(
            ['email' => 'admin@barber.test'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'phone' => '5599999999999',
                'active' => true,
            ]
        );

        $recep = User::firstOrCreate(
            ['email' => 'recepcao@barber.test'],
            [
                'name' => 'Recepção',
                'password' => Hash::make('password'),
                'role' => 'recepcao',
                'phone' => '5599999999998',
                'active' => true,
            ]
        );

        // Barbeiros (user + perfil Barber)
        $b1u = User::firstOrCreate(
            ['email' => 'barbeiro1@barber.test'],
            [
                'name' => 'Barbeiro 1',
                'password' => Hash::make('password'),
                'role' => 'barbeiro',
                'phone' => '5599999999991',
                'active' => true,
            ]
        );
        $b2u = User::firstOrCreate(
            ['email' => 'barbeiro2@barber.test'],
            [
                'name' => 'Barbeiro 2',
                'password' => Hash::make('password'),
                'role' => 'barbeiro',
                'phone' => '5599999999992',
                'active' => true,
            ]
        );

        $b1 = Barber::firstOrCreate(['user_id' => $b1u->id], ['bio' => 'Fade e navalha', 'active' => true]);
        $b2 = Barber::firstOrCreate(['user_id' => $b2u->id], ['bio' => 'Clássicos e barba quente', 'active' => true]);

        // ── Serviços ──────────────────────────────────────────────────
        foreach ([
            ['name' => 'Corte',          'duration_min' => 30, 'price' => 40.00, 'active' => true],
            ['name' => 'Barba',          'duration_min' => 20, 'price' => 30.00, 'active' => true],
            ['name' => 'Corte + Barba',  'duration_min' => 45, 'price' => 65.00, 'active' => true],
        ] as $s) {
            Service::firstOrCreate(['name' => $s['name']], $s);
        }

        // ── Clientes demo ─────────────────────────────────────────────
        for ($i = 1; $i <= 5; $i++) {
            Customer::firstOrCreate(
                ['phone' => '55988888888' . $i],
                [
                    'name' => "Cliente $i",
                    'email' => "cliente{$i}@barber.test",
                    'active' => true,
                ]
            );
        }

        // ── Horário de trabalho (seg–sáb 09–18 com 12–13 pausa) ──────
        foreach ([$b1, $b2] as $barber) {
            for ($w = 1; $w <= 6; $w++) { // 1=Seg ... 6=Sáb
                WorkingHour::firstOrCreate(
                    ['barber_id' => $barber->id, 'weekday' => $w],
                    [
                        'start_time'  => '09:00:00',
                        'end_time'    => '18:00:00',
                        'break_start' => '12:00:00',
                        'break_end'   => '13:00:00',
                    ]
                );
            }
        }

        // ── Plano + benefícios ────────────────────────────────────────
        $plan = Plan::firstOrCreate(
            ['name' => 'Mensal 2 cortes'],
            [
                'description' => 'Até 2 cortes por mês + 10% off na barba',
                'price_month' => 70.00,
                'active' => true,
            ]
        );

        PlanBenefit::firstOrCreate(['plan_id' => $plan->id, 'label' => '2 cortes/mês']);
        PlanBenefit::firstOrCreate(['plan_id' => $plan->id, 'label' => '10% off na barba']);
    }
}

