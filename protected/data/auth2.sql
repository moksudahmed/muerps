-- Role: "fahmed@metrouni.edu.bd"
-- DROP ROLE "fahmed@metrouni.edu.bd";

CREATE ROLE "fahmed@metrouni.edu.bd" WITH
  LOGIN
  SUPERUSER
  INHERIT
  NOCREATEDB
  NOCREATEROLE
  NOREPLICATION
  ENCRYPTED PASSWORD 'md5cd70214ae820d34d33429e987aebcc79';

GRANT "super-admin" TO "fahmed@metrouni.edu.bd";

-- Role: "moksud@metrouni.edu.bd"
-- DROP ROLE "moksud@metrouni.edu.bd";

CREATE ROLE "moksud@metrouni.edu.bd" WITH
  LOGIN
  SUPERUSER
  INHERIT
  CREATEDB
  CREATEROLE
  NOREPLICATION
  ENCRYPTED PASSWORD 'md57331c629ab4f8a6e224c5f1cdda94140';

GRANT "super-admin" TO "moksud@metrouni.edu.bd";



-- Role: "alamin@metrouni.edu.bd"
-- DROP ROLE "alamin@metrouni.edu.bd";

CREATE ROLE "alamin@metrouni.edu.bd" WITH
  LOGIN
  NOSUPERUSER
  INHERIT
  NOCREATEDB
  CREATEROLE
  NOREPLICATION
  ENCRYPTED PASSWORD 'md51b93325914673f9927859d9597a8ef7d';

GRANT admin TO "alamin@metrouni.edu.bd";

-- Role: "amin@metrouni.edu.bd"
-- DROP ROLE "amin@metrouni.edu.bd";

CREATE ROLE "amin@metrouni.edu.bd" WITH
  LOGIN
  NOSUPERUSER
  INHERIT
  NOCREATEDB
  CREATEROLE
  NOREPLICATION
  ENCRYPTED PASSWORD 'md54d270e639d838a152545f2e6ee8b48b6';

GRANT "super-admin" TO "amin@metrouni.edu.bd";

-- Role: "asad@metrouni.edu.bd"
-- DROP ROLE "asad@metrouni.edu.bd";

CREATE ROLE "asad@metrouni.edu.bd" WITH
  LOGIN
  NOSUPERUSER
  INHERIT
  NOCREATEDB
  NOCREATEROLE
  NOREPLICATION
  ENCRYPTED PASSWORD 'md51d5ad4bff16ad73e1c89846bb6c0ec07';

GRANT admin TO "asad@metrouni.edu.bd";

-- Role: "ghuznavi@gmail.com"
-- DROP ROLE "ghuznavi@gmail.com";

CREATE ROLE "ghuznavi@gmail.com" WITH
  LOGIN
  NOSUPERUSER
  INHERIT
  NOCREATEDB
  NOCREATEROLE
  NOREPLICATION
  ENCRYPTED PASSWORD 'md5310e76fd9d205d6c92e635ff5fcbc59d';

GRANT admission TO "ghuznavi@gmail.com";

-- Role: "kawsar@metrouni.edu.bd"
-- DROP ROLE "kawsar@metrouni.edu.bd";

CREATE ROLE "kawsar@metrouni.edu.bd" WITH
  LOGIN
  NOSUPERUSER
  INHERIT
  NOCREATEDB
  NOCREATEROLE
  NOREPLICATION
  ENCRYPTED PASSWORD 'md54f2e4b17e44efd4451fc4b3f114b0cc4';

GRANT admission, exam TO "kawsar@metrouni.edu.bd";

-- Role: "opusiddique@metrouni.edu.bd"
-- DROP ROLE "opusiddique@metrouni.edu.bd";

CREATE ROLE "opusiddique@metrouni.edu.bd" WITH
  LOGIN
  NOSUPERUSER
  INHERIT
  NOCREATEDB
  CREATEROLE
  NOREPLICATION
  ENCRYPTED PASSWORD 'md5d12dcb7123b829d028c25582721d8fd7';

GRANT admission, deo, exam, "super-admin" TO "opusiddique@metrouni.edu.bd";

-- Role: "shantiroy21@gmail.com"
-- DROP ROLE "shantiroy21@gmail.com";

CREATE ROLE "shantiroy21@gmail.com" WITH
  LOGIN
  NOSUPERUSER
  INHERIT
  NOCREATEDB
  NOCREATEROLE
  NOREPLICATION
  ENCRYPTED PASSWORD 'md559bc2d73ebc7c670dd18d7df74ffe374';

GRANT admission, registry TO "shantiroy21@gmail.com";

-- Role: "tanwir@metrouni.edu.bd"
-- DROP ROLE "tanwir@metrouni.edu.bd";

CREATE ROLE "tanwir@metrouni.edu.bd" WITH
  LOGIN
  NOSUPERUSER
  INHERIT
  NOCREATEDB
  CREATEROLE
  NOREPLICATION
  ENCRYPTED PASSWORD 'md5bf8bbbd34abe4457bcd20963bb2d5e4c';

GRANT admin TO "tanwir@metrouni.edu.bd";

-- Role: "tarek.islam@metrouni.edu.bd"
-- DROP ROLE "tarek.islam@metrouni.edu.bd";

CREATE ROLE "tarek.islam@metrouni.edu.bd" WITH
  LOGIN
  NOSUPERUSER
  INHERIT
  NOCREATEDB
  NOCREATEROLE
  NOREPLICATION
  ENCRYPTED PASSWORD 'md5bd8397f2d3bd219cafc7d908a2e71849';

GRANT admission TO "tarek.islam@metrouni.edu.bd";