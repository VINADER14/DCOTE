<?php
$pageTitle = 'Главная | DCOTE';
$bodyClass = 'page-home';
include __DIR__ . '/app/views/header.php';
?>
    <main class="page-dcote_main">
        <div class="content-line1">
            <div class="description scale-in">
                <div class="image_base scale-in"> 
                    <img src="images/index/base_dcote1.webp" fetchpriority="high" decoding="async" alt="Аяно, Арису, Сузуне, Кей, Рьюен, Шалава рядом"/>
                </div>
                <div class="description-text slide-in-left">
                    <div class="title">
                        <h1>ОПИСАНИЕ ПРОИЗВЕДЕНИЯ</h1>
                    </div>
                    <div class="text">
                        <p>
                            Добро пожаловать в класс превосходства — это напряжённая школьная драма с элементами психологического триллера,
                            действие которой разворачивается в престижной государственной школе Кодо Икусэй, известной идеальными условиями
                            и почти гарантированным будущим успехом для выпускников. Однако за внешним совершенством скрывается жестокая
                            система ранжирования, где учащиеся получают всё — от привилегий до денежных баллов — строго по заслугам
                            и результатам конкуренции.
                            <br><br>
                            Главный герой, таинственный и замкнутый Аянокоджи Киётака, по воле обстоятельств оказывается в худшем классе
                            D, куда отправляют «дефективных» учеников школы. Несмотря на намерение оставаться в тени, он постепенно
                            оказывается втянут в сложную игру интриг, стратегий и скрытых конфликтов между учениками школы.
                        </p>
                    </div>
                </div>
            </div>
            <div class="updates scale-in">
                <div class="updates-title">
                    <h1>АКТУАЛЬНОЕ</h1>
                </div>
                <div class="updates-news">
                    <ul>
                    </ul>
                </div>
                <div class="updates-link-wrapper">
                    <a class ="updates-link" href="https://dcote/news">Больше новостей</a>
                </div>
            </div>
        </div>
        <div class="content-line2">
            <div class="school-image-base scale-in">
                <img src="images/index/school_landscape.webp" fetchpriority="high" decoding="async" alt="Кодо Икусей фото скачать"/>
            </div>
            <div class="about-school slide-in-left">
                <div class="title-school">
                    <h1>СТОЛИЧНАЯ СТАРШАЯ ШКОЛА ПРОДВИНУТОГО ВОСПИТАНИЯ</h1>
                </div>
                <div class="text">
                    <p>Токийское государственное учебное учреждение, созданное японским правительством для воспитания молодых выпускников,
                        которые будут поддерживать различные профессиональные отрасли страны, что подкрепляется особыми методами обучения.
                        за счёт своей репутации, школа может похвастаться своим сто процентным уровнем занятости и поступления в колледж.
                        Сам кампус располагается на отдельном, искусственно сконструированном острове, площадь которого составляет около
                        шестиста тысяч квадратных метров.</p>
                    <div class="button">
                        <button class="tg-btn" onclick="window.location.href='/about_school.php'">БОЛЬШЕ ИНФОРМАЦИИ</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-line3">
            <div class="about-island slide-in-right">
                <div class="title">
                    <h1>ЭКЗАМЕНАЦИОННЫЙ ШКОЛЬНЫЙ ОСТРОВ</h1>
                </div>
                <div class="text">
                    <p>Необитаемый остров, что юридически принадлежит школе и периодически используется руководством для проведения
                        специальных экзаменов.<br><br>
                        Проведение таких экзаменов по традиции выпадает на начало нового года и знаменует собой всю серьёзность
                        выстроенной правительством школьной системой - выживание в диких условиях, работа в команде, противостояние группам оппонентов.
                        <br><br>Сам остров делится на специальные сектора, что предназначены для реального использования на специфичных по
                        правилам экзаменах.<br><br>Путешествия на остров происходят каждый год, что позволяет
                        выработать у учеников некую адаптацию к подобным условиям.</p>
                </div>
            </div>
            <div class="island-image-base scale-in">
                <img src="images/index/island-map.webp" loading="lazy"decoding="async" alt="Крутой остров фото скачать"/>
            </div>
        </div>
        <div class="content-line4">
            <div class="top-classes scale-in">
                <div class="title"><h1>РЕЙТИНГ КЛАССОВ</h1></div>
                <div class="top-classes-buttons">
                    <button class="classes-button-active">Без спойлеров</button>
                    <button class="classes-button-inactive">Со спойлерами</button>
                </div>
                <div class="top-table">
                    <table>
                        <thead>
                            <tr>
                                <th style="width:15%;"></th>
                                <th style="width:50%;"></th>
                                <th style="width:15%;"></th>
                                <th style="width:20%;"></th>
                            </tr>
                        </thead>
                        <tbody> 
                            <tr>
                                <td><img src="images/index/arisu-class.avif" alt=""></td>
                                <td class="class-lider"><h3>Класс Сакаянаги</h3></td>
                                <td class="class-letter"><h3>A</h3></td>
                                <td class="class-points"><h3>1119 к.о.</h3></td>
                            </tr>
                            <tr>
                                <td><img src="images/index/ichinose-class.avif" alt=""></td>
                                <td class="class-lider"><h3>Класс Ичиносе</h3></td>
                                <td class="class-letter"><h3>B</h3></td>
                                <td class="class-points"><h3>542 к.о.</h3></td>
                            </tr>
                            <tr>
                                <td><img src="images/index/ryuen-class.avif" alt=""></td>
                                <td class="class-lider"><h3>Класс Рьюена</h3></td>
                                <td class="class-letter"><h3>C</h3></td>
                                <td class="class-points"><h3>540 к.о.</h3></td>
                            </tr>
                            <tr>
                                <td><img src="images/index/suzune-class.avif" alt=""></td>
                                <td class="class-lider"><h3>Класс Хорикиты</h3></td>
                                <td class="class-letter"><h3>D</h3></td>
                                <td class="class-points"><h3>275 к.о.</h3></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="full-stat"><button>ПОЛНАЯ СТАТИСТИКА</button></div>
            </div>
            <div class="top-users scale-in">
                <div class="title"><h1>РЕЙТИНГ ПОЛЬЗОВАТЕЛЕЙ</h1></div>
                <div class="users-table">
                    <table>
                        <thead>
                            <tr>
                                <th class="rank-head" style="width:8%;"><p>Ранг</p></th>
                                <th style="width:8%;"></th>
                                <th class="nickname-head" style="width:35%;"><p>Пользователь</p></th>
                                <th class="status-head" style="width:35%;"><p>Статус</p></th>
                                <th class="rating-head" style="width:14%;"><p>Рейтинг</p></th>
                            </tr>
                        </thead>
                        <tbody> 
                            <tr>
                                <td class="rank"><p>#1</p></td>
                                <td><img src="images/index/2.webp" alt=""></td>
                                <td class="nickname"><p>MrEgor4ik</p></td>
                                <td class="status"><p>Команда проекта</p></td>
                                <td class="rating"><p>6969</p></td>
                            </tr>
                            <tr>
                                <td class="rank"><p>#2</p></td>
                                <td><img src="images/index/1.webp" alt=""></td>
                                <td class="nickname"><p>Andrey Andreev</p></td>
                                <td class="status"><p>Команда проекта</p></td>
                                <td class="rating"><p>6767</p></td>
                            </tr>
                            <tr>
                                <td class="rank"><p>#1</p></td>
                                <td><img src="images/index/3.webp" alt=""></td>
                                <td class="nickname"><p>Эйнштейн</p></td>
                                <td class="status"><p>Команда проекта</p></td>
                                <td class="rating"><p>5252</p></td>
                            </tr>
                            <tr>
                                <td class="rank"><p>#1</p></td>
                                <td><img src="images/index/4.webp" alt=""></td>
                                <td class="nickname"><p>TemZz</p></td>
                                <td class="status"><p>Команда проекта</p></td>
                                <td class="rating"><p>4242</p></td>
                            </tr>
                            <tr>
                                <td class="rank"><p>#1</p></td>
                                <td><img src="images/index/5.webp" alt=""></td>
                                <td class="nickname"><p>Popco1n</p></td>
                                <td class="status"><p>Команда проекта</p></td>
                                <td class="rating"><p>1488</p></td>
                            </tr>
                            <tr>
                                <td class="rank"><p>#1</p></td>
                                <td><img src="images/index/6.webp" alt=""></td>
                                <td class="nickname"><p>Vinader</p></td>
                                <td class="status"><p>Команда проекта</p></td>
                                <td class="rating"><p>666</p></td>
                            </tr>
                            <tr>
                                <td class="rank"><p>#1</p></td>
                                <td><img src="images/index/7.webp" alt=""></td>
                                <td class="nickname"><p>Чайник</p></td>
                                <td class="status"><p>Команда проекта</p></td>
                                <td class="rating"><p>100</p></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="full-stat"><button>ВСЕ ПОЛЬЗОВАТЕЛИ</button></div>
            </div>
        </div>
        <div class="buttons-containers">
            <div class="base-dcote scale-in">
                <div class="base-dcote-image">
                    <div class="image-wrapper">
                        <img src="images/index/tg1.webp" loading="lazy"decoding="async" alt="Картинка"/>
                    </div>
                </div>
                <div class="banner-info slide-in-top">
                    <div class="title">
                        <h1>ОБСУЖДЕНИЕ НОВОСТЕЙ</h1>
                    </div>
                    <div class="text">
                        <p>Беседа в мессенджере Telegram, где люди обсуждают актуальные новости и беседуют друг с другом</p>
                        <div class="button">
                            <button class="tg-btn" onclick="window.location.href='https://t.me/DCOTEFILES'">ПЕРЕЙТИ</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="base-dcote scale-in">
                <div class="base-dcote-image">
                    <div class="image-wrapper">
                        <img src="images/index/tg2.webp" loading="lazy"decoding="async" alt="Картинка для базы"/>
                    </div>
                </div>
                <div class="banner-info slide-in-top">
                    <div class="title">
                        <h1>ОБСУЖДЕНИЕ СПОЙЛЕРОВ</h1>
                    </div>
                    <div class="text">
                        <p>Беседа в мессенджере Telegram, где люди обсуждают спойлеры и беседуют друг с другом</p>
                        <div class="button">
                            <button class="tg-btn" onclick="window.location.href='https://t.me/DCOTESPOILERS2'">ПЕРЕЙТИ</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="base-dcote scale-in">
                <div class="base-dcote-image">
                    <div class="image-wrapper">
                        <img src="images/index/tg3.webp" loading="lazy"decoding="async" alt="Картинка для базы"/>
                    </div>
                </div>
                <div class="banner-info slide-in-top">
                    <div class="title">
                        <h1>ТЕОРИИ И РАЗБОРЫ</h1>
                    </div>
                    <div class="text">
                        <p>Обсуждение тех или иных горячих тем, что не до конца разобраны и разборы, как в ключевых, так и второстепенных фрагментов произведения</p>
                        <div class="button">
                            <button class="tg-btn" onclick="window.location.href='https://t.me/DCOTETHEORIES'">ПЕРЕЙТИ</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php include __DIR__ . '/app/views/footer.php'; ?>
</body>
</html>