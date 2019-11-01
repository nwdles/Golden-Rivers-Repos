<?php

use Illuminate\Database\Seeder;

class AuctionItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('auction_items')->insert([
            [
                'auction_item_name' => 'Диадема с изображением Эроса',
                'auction_id' => 2,
                'auction_item_info' => 'IV в. До н.э.',
                'auction_item_cost' => 5500000
            ],
            [
                'auction_item_name' => 'Золотое ожерелье',
                'auction_id' => 2,
                'auction_item_info' => 'IV в. До н.э.',
                'auction_item_cost' => 6500000
            ],
            [
                'auction_item_name' => 'Сетка с изображением менады',
                'auction_id' => 2,
                'auction_item_info' => 'II в. До н.э.',
                'auction_item_cost' => 1250000
            ],
            [
                'auction_item_name' => 'Серьги из кургана Куль-Оба',
                'auction_id' => 2,
                'auction_item_info' => 'Золото. На серьгах часто изображали почитаемых греками богов.',
                'auction_item_cost' => 7500000
            ],
            [
                'auction_item_name' => 'Браслет на предплечье с грифонами',
                'auction_id' => 2,
                'auction_item_info' => 'Золото',
                'auction_item_cost' => 4500000
            ],
            [
                'auction_item_name' => 'РЕВОЛЬВЕР WEBLEY «WG» M 1885',
                'auction_id' => 3,
                'auction_item_info' => 'В 1882 году компания «Webley & Son» приступила к выпуску револьвера, положившего начало хорошо известной и большой серии, получившей наименование «WG».',
                'auction_item_cost' => 1250000
            ],
            [
                'auction_item_name' => 'РЕВОЛЬВЕР WEBLEY-KAUFMANN',
                'auction_id' => 3,
                'auction_item_info' => 'В 1880 году фирма «Webley & Son» начала производство нового револьвера, получившего наименование «Webley-Kaufmann». Это оружие появилось благодаря разработкам талантливого конструктора стрелкового оружия Майкла Кауфмана',
                'auction_item_cost' => 1250000
            ],
            [
                'auction_item_name' => 'РЕВОЛЬВЕР JAMES HILL MODEL',
                'auction_id' => 3,
                'auction_item_info' => 'Одной из модификаций револьвера RIC стал короткоствольный вариант этого оружия, который был создан в 1880 году специально по заказу лондонского оружейника Вильяма Джеймса Хилла',
                'auction_item_cost' => 2500000
            ],
            [
                'auction_item_name' => 'РЕВОЛЬВЕР ADAMS M 1868 MK I',
                'auction_id' => 3,
                'auction_item_info' => 'В 1851 году Роберт Адамс запатентовал новую конструкцию самовзводного капсюльного револьвера собственной разработки.',
                'auction_item_cost' => 950000
            ],
            [
                'auction_item_name' => 'АВТОМАТИЧЕСКИЙ РЕВОЛЬВЕР WEBLEY-FOSBERY',
                'auction_id' => 3,
                'auction_item_info' => 'В конце XIX века полковник британской армии Джордж Винсент Фосбери изобрел конструкцию автоматического револьвера',
                'auction_item_cost' => 1550000
            ],
            [
                'auction_item_name' => 'Три любопытных кошки',
                'auction_id' => 4,
                'auction_item_info' => 'Профессор живописи Хейер Артур (1872-1931)  Около 1930 г.',
                'auction_item_cost' => 550000
            ],
            [
                'auction_item_name' => 'Женский портрет',
                'auction_id' => 4,
                'auction_item_info' => 'Годткнехт Август (1824-1888)',
                'auction_item_cost' => 250000
            ],
            [
                'auction_item_name' => 'Вид датского озера Тиструп',
                'auction_id' => 4,
                'auction_item_info' => 'Олстед Петер (1824-1887) 1850-х годов',
                'auction_item_cost' => 975000
            ],
            [
                'auction_item_name' => 'Убегающая лошадь',
                'auction_id' => 4,
                'auction_item_info' => 'Придворный художник немецкого короля Вильгельма I, австрийского императора Франца Иосифа I - Престель Иоганн Эрдман Готтлиб (1804-1885)',
                'auction_item_cost' => 1875000
            ],
            [
                'auction_item_name' => 'Шильонский замок у озера',
                'auction_id' => 4,
                'auction_item_info' => 'Академик и профессор живописи Королевской Академии художеств Янус Андреас ла Кур (1837-1909)',
                'auction_item_cost' => 880000
            ],
        ]);
    }
}
