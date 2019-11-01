<?php

use Illuminate\Database\Seeder;

class TicketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tickets')->insert([
            [
                'user_id' => 2,
                'ticket_status' => true,
                'show_id' => 1,
                'auction_id' => null,
                'ticket_comment' => 'Описание почему я хочу билет',
            ],
            [
                'user_id' => 10,
                'ticket_status' => true,
                'show_id' => 1,
                'auction_id' => null,
                'ticket_comment' => 'Еще одно описание почему я хочу билет',
            ],
            [
                'user_id' => 7,
                'ticket_status' => false,
                'show_id' => 1,
                'auction_id' => null,
                'ticket_comment' => 'Зачем покупать билет',
            ],
            [
                'user_id' => 9,
                'ticket_status' => true,
                'show_id' => 2,
                'auction_id' => null,
                'ticket_comment' => 'Хочу на эту прекрасную выставку',
            ],
            [
                'user_id' => 10,
                'ticket_status' => false,
                'show_id' => 2,
                'auction_id' => null,
                'ticket_comment' => 'Лучшая выставка на свете',
            ],
            [
                'user_id' => 13,
                'ticket_status' => true,
                'show_id' => 5,
                'auction_id' => null,
                'ticket_comment' => 'Надеюсь будет интересно',
            ],
            [
                'user_id' => 16,
                'ticket_status' => false,
                'show_id' => 5,
                'auction_id' => null,
                'ticket_comment' => 'Лайк репост',
            ],
            [
                'user_id' => 19,
                'ticket_status' => true,
                'auction_id' => 2,
                'show_id' => null,
                'ticket_comment' => 'Новый аукцион',
            ],
            [
                'user_id' => 2,
                'ticket_status' => true,
                'auction_id' => 3,
                'show_id' => null,
                'ticket_comment' => 'Самый больше цены аукциона?',
            ],
            [
                'user_id' => 10,
                'ticket_status' => false,
                'auction_id' => 4,
                'show_id' => null,
                'ticket_comment' => 'Как я могу удостоворится в подлинности?',
            ],
            [
                'user_id' => 5,
                'ticket_status' => true,
                'auction_id' => 4,
                'show_id' => null,
                'ticket_comment' => 'Высылаю все свои контактные данные',
            ],
            [
                'user_id' => 7,
                'ticket_status' => true,
                'auction_id' => 3,
                'show_id' => null,
                'ticket_comment' => 'Снова описание',
            ],
            [
                'user_id' => 9,
                'ticket_status' => false,
                'auction_id' => 2,
                'show_id' => null,
                'ticket_comment' => 'Кончилась фантазия на написание соре нот соре',
            ],
            [
                'user_id' => 13,
                'ticket_status' => false,
                'auction_id' => 4,
                'show_id' => null,
                'ticket_comment' => 'Стандартное описание',
            ],
        ]);
    }
}
