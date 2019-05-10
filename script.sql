delimiter |
CREATE  PROCEDURE getImageComments(in _id int(11))
begin
select idComment, C.idMember, idImage, description, date, firstName, lastName from Comments C INNER JOIN Members M ON C.idMember = M.idMember WHERE idImage = _id ORDER BY date DESC;
end |

delimiter |
CREATE  aliasExists(IN P_Username varchar(45))
BEGIN

	SELECT alias FROM Members WHERE alias = P_Username;

END |

delimiter |
CREATE  PROCEDURE getMemberById(in _id int(11))
begin
	select * from Members where idMember = _id;
end |

delimiter |
CREATE  PROCEDURE getImagesAndInfos()
begin
	select idImage, i.idMember, titre, description, alias, date from Images i inner join Members m on i.idMember = m.idMember order by date desc;
end |

delimiter |
CREATE  PROCEDURE getImageComments(in _id int(11))
begin
select idComment, C.idMember, idImage, description, date, firstName, lastName from Comments C INNER JOIN Members M ON C.idMember = M.idMember WHERE idImage = _id ORDER BY date DESC;
end |

CREATE  PROCEDURE getCommentCount(in _id INT(11))
begin
	select count(*) from Comments where idImage = _id;
    
end |

delimiter |
CREATE  PROCEDURE getImageInfo(in _id int(11))
begin
	select * from Images where idImage = _id;
end |

delimiter |
CREATE  PROCEDURE getMembers()
begin
	select * from Members;
end |

