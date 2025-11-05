# Avorado Fuvar

## Felhasználókhoz tartozó táblák

### Terv:

#### Adatbázis terv:

1. Szükség van authentikációra, ezt egy darab táblában tároljuk, jogosultság típussal együtt (Adminisztrátor, vagy Fuvarozó).
2. Fuvarozóknak van egy külön táblájuk, amiben benne vannak a feladatban kért adataik.
3. Mivel a 2-es pontban a Fuvarozókkal kezdtem, ezért szükség van hozzákapcsolódó Járművek táblára. A leírásban egy Fuvarozóhoz sok jármű rendelhető egyszerre.
4. Munka táblát is létre kell hozni, s 1 Munkát 1 fuvarozóhoz lehet csak rendelni (másik irányba több lehetsége) ezért csak 1 mezőt teszek be a táblába, ami jelzi, hogy melyik fuvarozóhoz van rendelve a munka.

### Kód terv:

1. Legenerálom az adattáblák alapján az alap kódokat.
2. Feladat kritériumai alapján alakítom ki a funkciókat