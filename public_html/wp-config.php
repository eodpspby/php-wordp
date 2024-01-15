<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки базы данных
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры базы данных: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'eodpsprugm' );

/** Имя пользователя базы данных */
define( 'DB_USER', 'eodpsprugm' );

/** Пароль к базе данных */
define( 'DB_PASSWORD', 'FgHwhHF4E7Z&zd4b' );

/** Имя сервера базы данных */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'IN/[`,kJTP=s4%P|h+PwY_HN-$0&Z(3-E$UH!LkqrjXlG2 g%9<nJ,kL]Wc%31x=' );
define( 'SECURE_AUTH_KEY',  '7VDrv1DZT#hdr^oRT&STUR^!O)*7d$`T0u^D*]<O9Y*3/scv@~KL* h7{i=U<8^5' );
define( 'LOGGED_IN_KEY',    '?;>Q6l%MK7KRJ$(u@i*RCg)jT5> n;e XQgI@v ,2B!P j6+u`1<=1+J}$#h4;0 ' );
define( 'NONCE_KEY',        'K&A#,W/E7 gsu;KE^8#NvhxR*k/f0jLcuC6L%[qp+c>Thyfr,YC*S)Wexx0`ouSK' );
define( 'AUTH_SALT',        'nQK#sz,[%FbHE0Zwn8H zb8r)SIwN1CZ^i(xAv`vKo.uPid`oi)5PaH~CbSMmdT?' );
define( 'SECURE_AUTH_SALT', 'G5%D-*j*mJ9r-.b2s?_i%{eLeA=8gOmU^uW5Z75@JWU9}PuR4SK)}^QUQV-Bxw@.' );
define( 'LOGGED_IN_SALT',   '.4D`.J#ua{/)8#z)2MWysMV49?vdRqS,Ag=/3vsf`{D:{hAMB{%WoO~$+_TS8tFH' );
define( 'NONCE_SALT',       'Ei9%Qx(Z) iv74}]K,OBA:{4=YM}:EXt?re3+dOaVkz%osatt{9ge{{][>Akh<%[' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */



/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
