<?php

use Illuminate\Database\Seeder;

class ShowItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('show_items')->insert([
            [
                'show_item_name' => 'Избраник Святослава',
                'show_id' => 1,
                'show_item_info' => 'Один из самых, пожалуй, уникальных экспонатов – «Изборник Святослава», время создания которого датируется 1073 годом.',
                'show_item_date_creation' => '1073 год',
                'show_item_author_fullname' => 'дьяк Иоанн',
            ],
            [
                'show_item_name' => 'Апостол',
                'show_id' => 1,
                'show_item_info' => 'Первая датированная печатная книга Московского государства – «Апостол» Ивана Федорова - была напечатана на французской бумаге в 1564 году.',
                'show_item_date_creation' => '1564 год',
                'show_item_author_fullname' => 'Иван Федоров',
            ],
            [
                'show_item_name' => 'Царская государственная печать',
                'show_id' => 1,
                'show_item_info' => 'Первое упоминание о печатях на Руси найдено в договоре X века между Русью и Византией.',
                'show_item_date_creation' => '900-e',
                'show_item_author_fullname' => 'цари Иван и Петр',
            ],
            [
                'show_item_name' => 'Спорок Алексея Михайловича',
                'show_id' => 1,
                'show_item_info' => 'Верх шубы царя Алексея Михайловича, спорок – бесценная вещь, которая дошла до наших дней с первой половины XVII века. Шуба на Руси была не просто одеждой, в которой можно было комфортно переносить лютый холод.',
                'show_item_date_creation' => 'первая половина 17 века',
                'show_item_author_fullname' => 'царь Алексей Михайлович',
            ],
            [
                'show_item_name' => 'Глобус Блау',
                'show_id' => 1,
                'show_item_info' => 'Уникальный экспонат картографической науки – напольный глобус Блау – был изготовлен в начале 90-х годов XVII века потомками известного картографа Блау для Карла XI.',
                'show_item_date_creation' => '90-е 17 века',
                'show_item_author_fullname' => 'потомки картографа Блау',
            ],
            [
                'show_item_name' => 'Добрый пастырь',
                'show_id' => 2,
                'show_item_info' => 'Мозаика',
                'show_item_date_creation' => '450-е годы',
                'show_item_author_fullname' => 'Неизвестный мастер V века',
            ],
            [
                'show_item_name' => 'Богоматерь на троне',
                'show_id' => 2,
                'show_item_info' => 'Мозаика',
                'show_item_date_creation' => 'до 526 года',
                'show_item_author_fullname' => 'Неизвестный мастер VI века',
            ],
            [
                'show_item_name' => 'Имератрица Феодора со свитой',
                'show_id' => 2,
                'show_item_info' => 'Мозаика',
                'show_item_date_creation' => '546-548 гг.',
                'show_item_author_fullname' => 'Неизвестный мастер VI века',
            ],
            [
                'show_item_name' => 'Император Юстиниан со свитой',
                'show_id' => 2,
                'show_item_info' => 'Мозаика',
                'show_item_date_creation' => '546-548 гг.',
                'show_item_author_fullname' => 'Неизвестный мастер VI века',
            ],
            [
                'show_item_name' => 'Рождество. Поклонение волхвов',
                'show_id' => 2,
                'show_item_info' => 'Дерево, темпера, позолота',
                'show_item_date_creation' => 'Первая треть XVI в.',
                'show_item_author_fullname' => 'Мастер Лихтенштейнского замка',
            ],
            [
                'show_item_name' => 'Азбука в картинах',
                'show_id' => 5,
                'show_item_info' => '«Азбука в картинах» Александра Бенуа — один из центральных экспонатов выставки. На обложку художник поместил свои любимые детские книжки, которые ангелы преподносят в качестве рождественских подарков (включая и саму «Азбуку в картинах»). Многие из них можно увидеть на выставке.',
                'show_item_date_creation' => '1904 год',
                'show_item_author_fullname' => 'Александр Бенуа',
            ],
            [
                'show_item_name' => 'The black Cat book',
                'show_id' => 5,
                'show_item_info' => 'Владелицей The black Cat book раньше была княжна Мария Романова, дочь Николая II, о чем свидетельствует дарственная надпись: «Дорогой Марии Н. от Сони. 1906». ',
                'show_item_date_creation' => '1906 год',
                'show_item_author_fullname' => 'Уолтер Коупленд Джеррольд',
            ],
            [
                'show_item_name' => 'Галчонок',
                'show_id' => 5,
                'show_item_info' => 'На выставке можно увидеть первый номер детского журнала «Галчонок», или «Галченок» (в соответствии с правилами написания начала ХХ века). ',
                'show_item_date_creation' => '1911 год',
                'show_item_author_fullname' => 'Алексей Редаков',
            ],
            [
                'show_item_name' => 'Макс и Мориц',
                'show_id' => 5,
                'show_item_info' => '«Макс и Мориц» — очень популярная немецкая книжка стихов с картинками середины ХIХ века, претендующая на звание первой книги комиксов. ',
                'show_item_date_creation' => '1904 год',
                'show_item_author_fullname' => 'Вильгельм Буш',
            ],
            [
                'show_item_name' => 'Детский сад',
                'show_id' => 5,
                'show_item_info' => 'Педагог Аделаида Симонович была родной теткой Валентина Серова, в силу сложившихся семейных обстоятельств заменившей ему мать. ',
                'show_item_date_creation' => '1907 год',
                'show_item_author_fullname' => 'Аделаида Симонович',
            ],
        ]);
    }
}
