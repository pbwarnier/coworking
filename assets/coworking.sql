#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: report
#------------------------------------------------------------

CREATE TABLE report(
        report_id Int  Auto_increment  NOT NULL ,
        category  Varchar (255) NOT NULL ,
        reason    Varchar (255) NOT NULL
	,CONSTRAINT report_PK PRIMARY KEY (report_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: users
#------------------------------------------------------------

CREATE TABLE users(
        users_id       Int  Auto_increment  NOT NULL ,
        gender         Int NOT NULL ,
        lastname       Varchar (255) NOT NULL ,
        firstname      Varchar (255) NOT NULL ,
        email          Varchar (255) NOT NULL ,
        password       Varchar (60) NOT NULL ,
        img            Varchar (255) NOT NULL ,
        birthdate      Date ,
        city           Int ,
        phone_number   Varchar (10) ,
        biography      Text ,
        permission     Int NOT NULL ,
        ban            Bool NOT NULL ,
        temporary_code Int ,
        multi_step     Bool NOT NULL ,
        section_id     Int ,
        company_id     Int NOT NULL
	,CONSTRAINT users_PK PRIMARY KEY (users_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: skills
#------------------------------------------------------------

CREATE TABLE skills(
        skills_id  Int  Auto_increment  NOT NULL ,
        skill_name Varchar (255) NOT NULL ,
        users_id   Int NOT NULL
	,CONSTRAINT skills_PK PRIMARY KEY (skills_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: works
#------------------------------------------------------------

CREATE TABLE works(
        works_id     Int  Auto_increment  NOT NULL ,
        occupation   Varchar (255) NOT NULL ,
        start        Date NOT NULL ,
        end          Date NOT NULL ,
        description  Text ,
        company_id   Int ,
        company_name Varchar (255) ,
        users_id     Int NOT NULL
	,CONSTRAINT works_PK PRIMARY KEY (works_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: company
#------------------------------------------------------------

CREATE TABLE company(
        company_id         Int  Auto_increment  NOT NULL ,
        company_code       Int NOT NULL ,
        company_name       Varchar (255) NOT NULL ,
        siret              Int NOT NULL ,
        address_number     Int ,
        number_complement  Int NOT NULL ,
        address            Varchar (255) NOT NULL ,
        address_complement Varchar (255) NOT NULL ,
        postcode           Int NOT NULL ,
        city               Int NOT NULL ,
        phone_number       Int NOT NULL ,
        mobile_phone       Int NOT NULL ,
        users_id           Int NOT NULL
	,CONSTRAINT company_PK PRIMARY KEY (company_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: list_login
#------------------------------------------------------------

CREATE TABLE list_login(
        list_login_id Int  Auto_increment  NOT NULL ,
        date          Datetime NOT NULL ,
        os            Varchar (255) NOT NULL ,
        navigator     Varchar (255) NOT NULL ,
        ipv4          Varchar (255) NOT NULL ,
        addr_mac      Varchar (50) NOT NULL ,
        users_id      Int NOT NULL
	,CONSTRAINT list_login_PK PRIMARY KEY (list_login_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: list_logout
#------------------------------------------------------------

CREATE TABLE list_logout(
        list_logout_id Int  Auto_increment  NOT NULL ,
        date           Datetime NOT NULL ,
        os             Varchar (255) NOT NULL ,
        navigator      Varchar (255) NOT NULL ,
        ipv4           Varchar (255) NOT NULL ,
        addr_mac       Varchar (50) NOT NULL ,
        users_id       Int NOT NULL
	,CONSTRAINT list_logout_PK PRIMARY KEY (list_logout_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: section
#------------------------------------------------------------

CREATE TABLE section(
        section_id Int  Auto_increment  NOT NULL ,
        name       Varchar (255) NOT NULL ,
        company_id Int NOT NULL ,
        users_id   Int NOT NULL
	,CONSTRAINT section_PK PRIMARY KEY (section_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ce
#------------------------------------------------------------

CREATE TABLE ce(
        ce_id      Int  Auto_increment  NOT NULL ,
        link       Varchar (11) NOT NULL ,
        company_id Int NOT NULL
	,CONSTRAINT ce_PK PRIMARY KEY (ce_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: posts
#------------------------------------------------------------

CREATE TABLE posts(
        posts_id   Int  Auto_increment  NOT NULL ,
        date       Datetime NOT NULL ,
        text       Text NOT NULL ,
        image_link Varchar (255) NOT NULL ,
        ban        Bool NOT NULL ,
        users_id   Int NOT NULL
	,CONSTRAINT posts_PK PRIMARY KEY (posts_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: comments
#------------------------------------------------------------

CREATE TABLE comments(
        comments_id    Int  Auto_increment  NOT NULL ,
        date           Datetime NOT NULL ,
        text           Text NOT NULL ,
        ban            Bool NOT NULL ,
        users_id       Int NOT NULL ,
        posts_id       Int NOT NULL
	,CONSTRAINT comments_PK PRIMARY KEY (comments_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: messages
#------------------------------------------------------------

CREATE TABLE messages(
        message_id        Int  Auto_increment  NOT NULL ,
        date              Datetime NOT NULL ,
        text              Text NOT NULL ,
        attachment        Varchar (255) ,
        view              Bool NOT NULL ,
        users_id          Int NOT NULL ,
        users_id_receiver Int NOT NULL
	,CONSTRAINT messages_PK PRIMARY KEY (message_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: list_report
#------------------------------------------------------------

CREATE TABLE list_report(
        list_report_id Int  Auto_increment  NOT NULL ,
        date           Datetime NOT NULL ,
        users_id       Int NOT NULL ,
        report_id      Int NOT NULL ,
        posts_id       Int NOT NULL
	,CONSTRAINT list_report_PK PRIMARY KEY (list_report_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: calendar
#------------------------------------------------------------

CREATE TABLE calendar(
        calendar_id  Int  Auto_increment  NOT NULL ,
        title        Varchar (255) NOT NULL ,
        date         Date NOT NULL ,
        time         Time ,
        localisation Varchar (255) ,
        notes        Varchar (255) NOT NULL ,
        users_id     Int NOT NULL
	,CONSTRAINT calendar_PK PRIMARY KEY (calendar_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: inscription
#------------------------------------------------------------

CREATE TABLE inscription(
        inscription_id Int  Auto_increment  NOT NULL ,
        DATE           Date NOT NULL ,
        access         Bool NOT NULL ,
        standby        Bool NOT NULL ,
        users_id       Int NOT NULL ,
        company_id     Int NOT NULL
	,CONSTRAINT inscription_PK PRIMARY KEY (inscription_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: devices
#------------------------------------------------------------

CREATE TABLE devices(
        devices_id    Int  Auto_increment  NOT NULL ,
        list_login_id Int NOT NULL
	,CONSTRAINT devices_PK PRIMARY KEY (devices_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: likes
#------------------------------------------------------------

CREATE TABLE likes(
        likes_id Int  Auto_increment  NOT NULL ,
        date     Datetime NOT NULL ,
        users_id Int NOT NULL ,
        posts_id Int NOT NULL
	,CONSTRAINT likes_PK PRIMARY KEY (likes_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Freeze
#------------------------------------------------------------

CREATE TABLE freeze(
        freeze_id Int NOT NULL Auto_increment,
        users_id         Int NOT NULL ,
        users_id_freeze Int NOT NULL
	,CONSTRAINT Freeze_PK PRIMARY KEY (freeze_id)
)ENGINE=InnoDB;




ALTER TABLE users
	ADD CONSTRAINT users_section0_FK
	FOREIGN KEY (section_id)
	REFERENCES section(section_id);

ALTER TABLE users
	ADD CONSTRAINT users_company1_FK
	FOREIGN KEY (company_id)
	REFERENCES company(company_id);

ALTER TABLE users 
	ADD CONSTRAINT users_company0_AK 
	UNIQUE (company_id);

ALTER TABLE skills
	ADD CONSTRAINT skills_users0_FK
	FOREIGN KEY (users_id)
	REFERENCES users(users_id);

ALTER TABLE works
	ADD CONSTRAINT works_users0_FK
	FOREIGN KEY (users_id)
	REFERENCES users(users_id);

ALTER TABLE company
	ADD CONSTRAINT company_users0_FK
	FOREIGN KEY (users_id)
	REFERENCES users(users_id);

ALTER TABLE company 
	ADD CONSTRAINT company_users0_AK 
	UNIQUE (users_id);

ALTER TABLE list_login
	ADD CONSTRAINT list_login_users0_FK
	FOREIGN KEY (users_id)
	REFERENCES users(users_id);

ALTER TABLE list_logout
	ADD CONSTRAINT list_logout_users0_FK
	FOREIGN KEY (users_id)
	REFERENCES users(users_id);

ALTER TABLE section
	ADD CONSTRAINT section_company0_FK
	FOREIGN KEY (company_id)
	REFERENCES company(company_id);

ALTER TABLE section
	ADD CONSTRAINT section_users1_FK
	FOREIGN KEY (users_id)
	REFERENCES users(users_id);

ALTER TABLE ce
	ADD CONSTRAINT ce_company0_FK
	FOREIGN KEY (company_id)
	REFERENCES company(company_id);

ALTER TABLE ce 
	ADD CONSTRAINT ce_company0_AK 
	UNIQUE (company_id);

ALTER TABLE posts
	ADD CONSTRAINT posts_users0_FK
	FOREIGN KEY (users_id)
	REFERENCES users(users_id);

ALTER TABLE comments
	ADD CONSTRAINT comments_users0_FK
	FOREIGN KEY (users_id)
	REFERENCES users(users_id);

ALTER TABLE comments
	ADD CONSTRAINT comments_posts1_FK
	FOREIGN KEY (posts_id)
	REFERENCES posts(posts_id);

ALTER TABLE messages
	ADD CONSTRAINT messages_users0_FK
	FOREIGN KEY (users_id)
	REFERENCES users(users_id);

ALTER TABLE messages
	ADD CONSTRAINT messages_users1_FK
	FOREIGN KEY (users_id_receiver)
	REFERENCES users(users_id);

ALTER TABLE list_report
	ADD CONSTRAINT list_report_users0_FK
	FOREIGN KEY (users_id)
	REFERENCES users(users_id);

ALTER TABLE list_report
	ADD CONSTRAINT list_report_report1_FK
	FOREIGN KEY (report_id)
	REFERENCES report(report_id);

ALTER TABLE list_report
	ADD CONSTRAINT list_report_posts2_FK
	FOREIGN KEY (posts_id)
	REFERENCES posts(posts_id);

ALTER TABLE calendar
	ADD CONSTRAINT calendar_users0_FK
	FOREIGN KEY (users_id)
	REFERENCES users(users_id);

ALTER TABLE inscription
	ADD CONSTRAINT inscription_users0_FK
	FOREIGN KEY (users_id)
	REFERENCES users(users_id);

ALTER TABLE inscription
	ADD CONSTRAINT inscription_company1_FK
	FOREIGN KEY (company_id)
	REFERENCES company(company_id);

ALTER TABLE devices
	ADD CONSTRAINT devices_list_login0_FK
	FOREIGN KEY (list_login_id)
	REFERENCES list_login(list_login_id);

ALTER TABLE likes
	ADD CONSTRAINT likes_users0_FK
	FOREIGN KEY (users_id)
	REFERENCES users(users_id);

ALTER TABLE likes
	ADD CONSTRAINT likes_posts1_FK
	FOREIGN KEY (posts_id)
	REFERENCES posts(posts_id);

ALTER TABLE Freeze
	ADD CONSTRAINT Freeze_users0_FK
	FOREIGN KEY (users_id)
	REFERENCES users(users_id);

ALTER TABLE Freeze
	ADD CONSTRAINT Freeze_users1_FK
	FOREIGN KEY (users_id_Freeze)
	REFERENCES users(users_id);
