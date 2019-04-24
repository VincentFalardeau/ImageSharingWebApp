use dbequipe14;

create table departements (codeDep char(3), nomDeparement varchar(30), constraint pkdept primary key(codeDep));

create table Employes
(numEmp int AUTO_INCREMENT,
nom varchar(30) not null,
prenom varchar(30) not null,
 codeDep char(3),
 constraint pkemploye primary key(numEmp),
 CONSTRAINT fkded foreign key(codeDep) references departements (codeDep)
 );


use dbequipe14;
insert into departements values('inf','Informatique');
insert into departements values('rsh','Ressources humaines');
insert into departements values('mat','Mathématiques');


insert into Employes(nom,prenom,codeDep) values('Patoche','Alain','inf');
insert into Employes(nom,prenom,codeDep) values('Leroy','Pierre','inf');
insert into Employes(nom,prenom,codeDep) values('Lemoine','Kevin','inf');
insert into Employes(nom,prenom,codeDep) values('Saturne','Alain','mat');
insert into Employes(nom,prenom,codeDep) values('Fafar','Annie','inf');


DELIMITER |
create procedure insertionEmp(in pnom varchar(30)
                              ,in pprn varchar(30),
                              in pcode  char(3)
                             )
BEGIN
    insert into Employes (nom,prenom,codeDep) values(pnom,pprn,pcode);
    commit;                          
    END   

--------------
CREATE PROCEDURE `insertionEmployes`(IN `pnom` VARCHAR(30), IN `pprn` VARCHAR(30), IN `pcode` 
CHAR(3))
 NOT DETERMINISTIC NO SQL SQL 
SECURITY DEFINER insert into Employes(nom,prenom,codeDep) values(pnom,pprn,pcode);
--------------

delimiter |
create procedure listeEmpDept(in pcode char(3))
 BEGIN
 select nom,prenom from Employes where codeDep = pcode;
 end |
----------------------------
delimiter |
create function EmpDep (pcode char(3)) returns integer
BEGIN

DECLARE

total integer;
select count(*) into total from Employes where codeDep=pcode;
return total;
end|




