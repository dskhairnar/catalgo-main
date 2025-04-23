<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\User;
use App\Models\Service;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users except business owners (assuming they have role 'user')
        $users = User::where('role', 'user')->get();
        
        // Get all active services
        $services = Service::where('status', 'active')->get();
        
        if ($users->isEmpty() || $services->isEmpty()) {
            $this->command->info('Please ensure there are users and services in the database first.');
            return;
        }

        // Create bookings for the past week and upcoming week
        $startDate = Carbon::now()->subWeek();
        $endDate = Carbon::now()->addWeek();

        $statuses = ['pending', 'confirmed', 'completed', 'cancelled'];
        
        // For each service, create 3-5 bookings
        foreach ($services as $service) {
            $numberOfBookings = rand(3, 5);
            
            for ($i = 0; $i < $numberOfBookings; $i++) {
                // Random date between start and end date
                $bookingDate = Carbon::createFromTimestamp(
                    rand($startDate->timestamp, $endDate->timestamp)
                );
                
                // Set time between 9 AM and 5 PM
                $bookingTime = Carbon::createFromFormat('H:i', sprintf('%02d:00', rand(9, 17)));
                
                // Combine date and time
                $bookingDateTime = Carbon::create(
                    $bookingDate->year,
                    $bookingDate->month,
                    $bookingDate->day,
                    $bookingTime->hour,
                    $bookingTime->minute
                );

                // For past dates, use completed or cancelled status
                // For future dates, use pending or confirmed status
                $status = $bookingDateTime->isPast() 
                    ? $statuses[array_rand(['completed', 'cancelled'])]
                    : $statuses[array_rand(['pending', 'confirmed'])];

                // Create the booking
                Booking::create([
                    'user_id' => $users->random()->id,
                    'service_id' => $service->id,
                    'booking_date' => $bookingDateTime->toDateString(),
                    'booking_time' => $bookingDateTime->toTimeString(),
                    'status' => $status,
                    'notes' => $this->generateRandomNote($status),
                ]);
            }
        }
    }

    private function generateRandomNote($status)
    {
        $notes = [
            'pending' => [
                'Looking forward to this service!',
                'Please confirm my preferred time if possible.',
                'First time trying this service.',
                'Special requests will be discussed during the service.',
            ],
            'confirmed' => [
                'Thank you for confirming my booking.',
                'See you at the scheduled time!',
                'Please let me know if anything changes.',
                'Looking forward to our appointment.',
            ],
            'completed' => [
                'Great service, thank you!',
                'Everything went well.',
                'Service completed as expected.',
                'Very satisfied with the service.',
            ],
            'cancelled' => [
                'Had to cancel due to emergency.',
                'Schedule conflict, will rebook later.',
                'Sorry for the late cancellation.',
                'Need to reschedule for another day.',
            ],
        ];

        return $notes[$status][array_rand($notes[$status])];
    }
}
