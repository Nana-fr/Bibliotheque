DROP DATABASE IF EXISTS library_php;
CREATE DATABASE library_php CHARACTER SET utf8;
USE library_php;

DROP USER IF EXISTS 'libraryPHP'@'localhost';
CREATE USER 'libraryPHP'@'localhost' IDENTIFIED BY 'library76';
GRANT ALL PRIVILEGES ON library_php.* TO 'libraryPHP'@'localhost';

CREATE TABLE Nationality (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    PRIMARY KEY (id)
)
ENGINE=INNODB;

INSERT INTO Nationality
VALUES (1, "Anglais"),
        (2, "Français"),
        (3, "Chinois");

CREATE TABLE Writer (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    nationalityId INT UNSIGNED NOT NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_nationalityId
        FOREIGN KEY (nationalityId)
        REFERENCES Nationality(id)
)
ENGINE=INNODB;

INSERT INTO Writer
VALUES (1, "Victor", "HUGO", 2),
        (2, "William", "SHAKESPEARE", 1),
        (3, "Jane", "AUSTEN", 1),
        (4, "Xueqin", "CAO", 3),
        (5, "Alexandre", "DUMAS", 2),
        (6, "Emily", "BRONTË", 1),
        (7, "Cheng'en", "WU", 3),
        (8, "Nai'an", "SHI", 3),
        (9, "Charles", "BAUDELAIRE", 2),
        (10, "Mary", "SHELLEY", 1),
        (11, "Guanzhong", "LUO", 3);
        

CREATE TABLE Category (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    PRIMARY KEY (id)
)
ENGINE=INNODB;

INSERT INTO Category
VALUES (1, "Roman"),
        (2, "Pièce de théâtre"),
        (3, "Poésie");

CREATE TABLE Language (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    PRIMARY KEY (id)
)
ENGINE=INNODB;

INSERT INTO Language
VALUES (1, "English"),
        (2, "Français"),
        (3, "中文");

CREATE TABLE Status (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    PRIMARY KEY (id)
)
ENGINE=INNODB;

INSERT INTO Status
VALUES (1, "Disponible"),
        (2, "Emprunté"),
        (3, "En réparation"),
        (4, "En commande"),
        (5, "Réservé"),
        (6, "Perdu");

CREATE TABLE Book (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    title VARCHAR(50) NOT NULL,
    writerId INT UNSIGNED NOT NULL,
    plot TEXT NOT NULL,
    languageId INT UNSIGNED NOT NULL,
    publication_date VARCHAR(20) NOT NULL,
    categoryId INT UNSIGNED NOT NULL,
    statusId INT UNSIGNED NOT NULL,
    borrowing_date Date,
    returning_date Date,
    PRIMARY KEY (id),
    CONSTRAINT FK_writerId
        FOREIGN KEY (writerId)
        REFERENCES Writer(id),
    CONSTRAINT FK_languageId
        FOREIGN KEY (languageId)
        REFERENCES Language(id),
    CONSTRAINT FK_categoryId
        FOREIGN KEY (categoryId)
        REFERENCES Category(id),
    CONSTRAINT FK_statusId
        FOREIGN KEY (statusId)
        REFERENCES Status(id)
)
ENGINE=INNODB;

INSERT INTO Book
VALUES (1, "Les misérables", 1, 
"Le destin de Jean Valjean, forçat échappé du bagne, est bouleversé par sa rencontre avec Fantine. 
Mourante et sans le sou, celle-ci lui demande de prendre soin de Cosette, sa fille confiée aux Thénardier. 
Ce couple d’aubergistes, malhonnête et sans scrupules, exploitent la fillette jusqu’à ce que Jean Valjean 
tienne sa promesse et l’adopte. Cosette devient alors sa raison de vivre. Mais son passé le rattrape et 
l’inspecteur Javert le traque…", 2, '1862', 1, 1, NULL, NULL),
        (2, "Romeo and Juliet", 2, "An age-old vendetta between two powerful families erupts into bloodshed.", 1, '1597', 2, 1, NULL, NULL),
        (3, "Pride and Prejudice", 3, "When Charles Bingley, a rich single man, moves to the Netherfield estate, 
        the neighborhood residents are thrilled, especially Mrs. Bennet, who hopes to marry one of her five daughters 
        to him. When the Bennet daughters meet him at a local ball, they are impressed by his outgoing 
        personality and friendly disposition. They are less impressed, however, by Bingley's friend 
        Fitzwilliam Darcy, a landowning aristocrat who is too proud to speak to any of the locals and whom 
        Elizabeth Bennet overhears refusing to dance with her.", 1, '1813-01-28', 1, 1, NULL, NULL),
        (4, "Frankenstein", 10, "An English explorer, Robert Walton, is on an expedition to the North Pole. 
        In letters to his sister Margaret Saville, he keeps his family informed of his situation and tells 
        about the difficult conditions on the ship. One day, when the ship is completely surrounded by ice, 
        a man in bad condition is taken aboard: Victor Frankenstein. As soon as his health allows it, he tells 
        Walton the story of his life.", 1, '1818-01-01', 1, 1, NULL, NULL),
        (5, "Le comte de Monte-Cristo", 5, "1815. Louis XVIII rétabli sur le trône se heurte à une opposition
         dont l'Empereur, relégué à l'île d'Elbe, songe déjà à profiter. Dans Marseille livrée à la 
         discorde civile, le moment est propice aux règlements de comptes politiques ou privés. 
         C'est ainsi que le marin Edmond Dantès, à la veille de son mariage, se retrouve, sans savoir 
         pourquoi, arrêté et conduit au château d'If... ", 2, '1844-46', 1, 1, NULL, NULL),
        (6, "Wuthering Heights", 6, "In 1801, Mr Lockwood, the new tenant at Thrushcross Grange in Yorkshire, 
        pays a visit to his landlord, Heathcliff, at his remote moorland farmhouse, Wuthering Heights. 
        There he meets a reserved young woman (later identified as Cathy Linton); Joseph, a cantankerous servant; 
        and Hareton, an uneducated young man who speaks like a servant. Everyone is sullen and inhospitable. 
        Snowed in for the night, Lockwood reads the diary of the former inhabitant of his room, Catherine Earnshaw, 
        and has a nightmare in which a ghostly Catherine begs to enter through the window. Woken by Lockwood's fearful 
        yells, Heathcliff is troubled. Lockwood later returns to Thrushcross Grange in heavy snow, falls ill from 
        the cold and becomes bedridden. While he recovers, Lockwood's housekeeper Ellen 'Nelly' Dean tells him the 
        story of the strange family. ", 1, '1847-12', 1, 1, NULL, NULL),
        (7, "红楼梦", 4, "《红楼梦》故事主线为贾宝玉、林黛玉及薛宝钗三人的爱情与婚姻悲剧，以及贾宝玉亲戚贾府、史家、薛家、
        王家等四大家族的兴衰。", 3, '1791', 1, 1, NULL, NULL),
        (8, "Les fleurs du mal", 9, "Avec Les Fleurs du Mal commence la poésie moderne : le lyrisme subjectif 
        s'efface devant cette « impersonnalité volontaire » que Baudelaire a lui-même postulée ; la nature et 
        ses retours cycliques cèdent la place au décor urbain et à ses changements marqués par l'Histoire, et 
        il arrive que le poète accède au beau par l'expérience de la laideur. Quant au mal affiché dès le titre 
        du recueil, s'il nous apporte la preuve que l'art ici se dénoue de la morale, il n'en préserve pas moins 
        la profonde spiritualité des poèmes. D'où la stupeur que Baudelaire put ressentir quand le Tribunal de la 
        Seine condamna la première édition de 1857 pour « outrage à la morale publique et aux bonnes moeurs » et 
        l'obligea à retrancher six pièces du volume - donc à remettre en cause la structure du recueil qu'il avait 
        si précisément concertée. En 1861, la seconde édition fut augmentée de trente-cinq pièces, puis Baudelaire 
        continua d'écrire pour son livre d'autres poèmes encore. Mais après la censure, c'est la mort qui vint 
        l'empêcher de donner aux Fleurs du Mal la forme définitive qu'il souhaitait - et que nous ne connaîtrons 
        jamais.", 2, '1857-08-23', 3, 1, NULL, NULL),
        (9, "三国演义", 11, "故事背景由公元184年東漢末年黃巾之亂開始，至公元280年西晉統一，共96年歷史，以儒家政治道德观念為
        核心主旨，同时揉合千百年来广大民众心理，表现对昏君贼臣大乱天下的痛恨，对明君良臣清平世界的渴慕。", 3, 
        '14th century', 1, 1, NULL, NULL),
        (10, "西游记", 7, "全书主要描写了孙悟空出世及大闹天宫后，遇见了唐僧、猪八戒、沙僧和白龙马，西行取经，一路上历经艰险、
        妖怪魔法高强，经历了九九八十一难，终于到达西天见到如来佛祖，最终五圣成真的故事。该小说以“唐僧取经”这一历史事件为蓝本，
        通过作者的艺术加工，深刻地描绘了明代社会现实。", 3, "1592", 1, 1, NULL, NULL),
        (11, "水浒传", 8, "故事描寫了一百零八將各自不同的故事，從他們一個個被逼上梁山、逐漸壯大、起義造反到最後接受招安的
        全過程。", 3, "14th century", 1, 1, NULL, NULL),
        (12, "Ruy Blas", 1, "L'action se déroule dans l'Espagne de la fin du XVIIe siècle, sur plusieurs mois. 
        Le héros de ce drame romantique, Ruy Blas, déploie son intelligence et son éloquence, autant pour dénoncer 
        et humilier une oligarchie accapareuse des biens de l'État que pour se montrer digne d'aimer la reine 
        d'Espagne. Mais cette voix du peuple, éprise de justice, éclairée par l'amour, est prisonnière d'une livrée 
        de valet et d'un maître attaché à perdre la réputation de la Reine en lui donnant « son laquais pour amant ».", 2,
        '1838-11-08', 2, 1, NULL, NULL);