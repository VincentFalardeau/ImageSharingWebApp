delimiter |
create procedure getMember(in _alias varchar(45), in _password varchar(45))
begin
	select idMember from Members where alias = _alias and password = _password;
end |

delimiter |
create procedure getMemberByAlias(in _alias varchar(45))
begin
	select idMember from Members where alias = _alias;
end |

delimiter |
create procedure listAllImages()
begin
	select idImage, idMember, titre, description from Images;
end |