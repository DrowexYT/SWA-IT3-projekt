# Herní databáze

Tento projekt je webová aplikace pro správu herní databáze. Umožňuje uživatelům prohlížet hry a administrátorům spravovat obsah databáze.

## Funkce aplikace

### Pro běžné uživatele
- **Zobrazení seznamu her** – uživatelé si mohou prohlížet hry uložené v databázi.
- **Přihlášení a odhlášení** – možnost přihlášení pomocí uživatelského jména a hesla.

### Pro administrátory
- **Přidávání her** – administrátor může přidávat nové hry do databáze.
- **Úprava her** – možnost změnit název, žánr, popis, hodnocení a cenu existujících her.
- **Odstranění her** – administrátor může mazat hry z databáze.

## Struktura souborů
- `index.php` – hlavní stránka aplikace.
- `login.php` – přihlašovací stránka.
- `dashboard.php` – uživatelský panel.
- `admin_dashboard.php` – administrační panel.
- `add_game.php` – formulář pro přidání nové hry.
- `edit_game.php` – stránka pro úpravu existující hry.
- `delete_game.php` – stránka pro mazání hry.
- `db_connection.php` – soubor pro připojení k databázi.

## Požadavky
- Webový server (např. Apache, Nginx nebo Laragon)
- PHP
- MySQL databáze

## Instalace
1. Naklonujte repozitář do svého serverového adresáře.
2. Upravte `db_connection.php` a nastavte správné přihlašovací údaje k databázi.
3. Importujte databázovou strukturu.
4. Spusťte aplikaci na serveru a přihlaste se jako administrátor.

## Autoři
Tento projekt byl vytvořen jako součást školního zadání pro správu databáze her.
