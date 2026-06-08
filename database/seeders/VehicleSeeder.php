<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        $sport = Category::firstOrCreate(
            ['name' => 'Sport'],
            ['description' => 'Véhicules haut de gamme et sportifs']
        );

        $premium = Category::firstOrCreate(
            ['name' => 'Premium'],
            ['description' => 'Véhicules de luxe et confort supérieur']
        );

        $citadine = Category::firstOrCreate(
            ['name' => 'Citadine'],
            ['description' => 'Véhicules compacts et économiques']
        );

        $berline = Category::firstOrCreate(
            ['name' => 'Berline'],
            ['description' => 'Voitures élégantes pour la ville']
        );

        $suv = Category::firstOrCreate(
            ['name' => 'SUV'],
            ['description' => 'Véhicules spacieux et confortables']
        );

        $vehicles = [
            [
                'brand' => 'Lamborghini',
                'model' => 'Aventador',
                'year' => 2022,
                'registration_number' => 'LV-AV-001',
                'category_id' => $sport->id,
                'image' => null,
                'price_per_day' => 450000,
                'availability' => 'available',
                'transmission' => 'automatic',
                'fuel_type' => 'petrol',
                'seats' => 2,
                'description' => 'Supercar emblématique à moteur V12, idéale pour une location prestige.',
            ],
            [
                'brand' => 'BMW',
                'model' => 'i8',
                'year' => 2020,
                'registration_number' => 'BM-I8-002',
                'category_id' => $premium->id,
                'image' => null,
                'price_per_day' => 220000,
                'availability' => 'available',
                'transmission' => 'automatic',
                'fuel_type' => 'hybrid',
                'seats' => 4,
                'description' => 'Coupé hybride rechargeable au design moderne et à la conduite sportive.',
            ],
            [
                'brand' => 'Citroën',
                'model' => 'C3',
                'year' => 2021,
                'registration_number' => 'CT-C3-003',
                'category_id' => $citadine->id,
                'image' => null,
                'price_per_day' => 25000,
                'availability' => 'available',
                'transmission' => 'manual',
                'fuel_type' => 'petrol',
                'seats' => 5,
                'description' => 'Citadine pratique, économique et parfaite pour la ville.',
            ],
            [
                'brand' => 'Citroën',
                'model' => 'C1',
                'year' => 2020,
                'registration_number' => 'CT-C1-004',
                'category_id' => $citadine->id,
                'image' => null,
                'price_per_day' => 20000,
                'availability' => 'available',
                'transmission' => 'manual',
                'fuel_type' => 'petrol',
                'seats' => 4,
                'description' => 'Petite voiture économique, très adaptée aux trajets urbains.',
            ],
            [
                'brand' => 'Renault',
                'model' => 'Clio',
                'year' => 2021,
                'registration_number' => 'RN-CL-005',
                'category_id' => $citadine->id,
                'image' => null,
                'price_per_day' => 28000,
                'availability' => 'available',
                'transmission' => 'manual',
                'fuel_type' => 'petrol',
                'seats' => 5,
                'description' => 'Citadine polyvalente, idéale pour les petits trajets quotidiens.',
            ],
            [
                'brand' => 'Peugeot',
                'model' => '208',
                'year' => 2022,
                'registration_number' => 'PG-208-006',
                'category_id' => $citadine->id,
                'image' => null,
                'price_per_day' => 30000,
                'availability' => 'available',
                'transmission' => 'automatic',
                'fuel_type' => 'petrol',
                'seats' => 5,
                'description' => 'Voiture compacte moderne, confortable et économique.',
            ],
            [
                'brand' => 'Toyota',
                'model' => 'Corolla',
                'year' => 2023,
                'registration_number' => 'TY-CR-007',
                'category_id' => $berline->id,
                'image' => null,
                'price_per_day' => 35000,
                'availability' => 'available',
                'transmission' => 'automatic',
                'fuel_type' => 'hybrid',
                'seats' => 5,
                'description' => 'Berline fiable et confortable, parfaite pour les trajets professionnels.',
            ],
            [
                'brand' => 'Hyundai',
                'model' => 'Elantra',
                'year' => 2022,
                'registration_number' => 'HY-EL-008',
                'category_id' => $berline->id,
                'image' => null,
                'price_per_day' => 33000,
                'availability' => 'available',
                'transmission' => 'automatic',
                'fuel_type' => 'petrol',
                'seats' => 5,
                'description' => 'Berline élégante et économique.',
            ],
            [
                'brand' => 'Toyota',
                'model' => 'RAV4',
                'year' => 2023,
                'registration_number' => 'TY-RV-009',
                'category_id' => $suv->id,
                'image' => null,
                'price_per_day' => 45000,
                'availability' => 'available',
                'transmission' => 'automatic',
                'fuel_type' => 'hybrid',
                'seats' => 5,
                'description' => 'SUV moderne et confortable.',
            ],
            [
                'brand' => 'Nissan',
                'model' => 'Qashqai',
                'year' => 2022,
                'registration_number' => 'NS-QA-010',
                'category_id' => $suv->id,
                'image' => null,
                'price_per_day' => 42000,
                'availability' => 'available',
                'transmission' => 'automatic',
                'fuel_type' => 'petrol',
                'seats' => 5,
                'description' => 'SUV compact polyvalent, idéal pour la famille.',
            ],
            [
                'brand' => 'Mercedes-Benz',
                'model' => 'C200',
                'year' => 2021,
                'registration_number' => 'MB-C2-011',
                'category_id' => $premium->id,
                'image' => null,
                'price_per_day' => 75000,
                'availability' => 'available',
                'transmission' => 'automatic',
                'fuel_type' => 'petrol',
                'seats' => 5,
                'description' => 'Berline premium élégante et confortable.',
            ],
            [
                'brand' => 'Audi',
                'model' => 'A4',
                'year' => 2022,
                'registration_number' => 'AU-A4-012',
                'category_id' => $premium->id,
                'image' => null,
                'price_per_day' => 70000,
                'availability' => 'available',
                'transmission' => 'automatic',
                'fuel_type' => 'petrol',
                'seats' => 5,
                'description' => 'Berline premium alliant confort et performance.',
            ],
        ];

        foreach ($vehicles as $vehicle) {
            Vehicle::updateOrCreate(
                ['registration_number' => $vehicle['registration_number']],
                $vehicle
            );
        }
    }
}