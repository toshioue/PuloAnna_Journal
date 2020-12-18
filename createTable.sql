DROP TABLE IF EXISTS entries;

CREATE TABLE "entries"
(
    [EntryNumber] INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    [Date] TEXT NOT NULL,
    [Subj] NVARCHAR(200)  NOT NULL,
    [Entry] TEXT NOT NULL,
    [Misc] BLOB NULL
);

/*Test insertion statement */
/*INSERT INTO entries (Date, Subj, Entry) Values ("July 28, 2020", "First Entry", "So i went for a walk today and it went well. ");
INSERT INTO entries (Date, Subj, Entry) Values ("July 29, 2020", "First Entry", "So i went for a walk today and it went well. ");
INSERT INTO entries (Date, Subj, Entry) Values ("July 30, 2020", "First Entry", "So i went for a walk today and it went well. ");
INSERT INTO entries (Date, Subj, Entry) Values ("August 1, 2020", "First Entry", "So i went for a walk today and it went well. ");
*/
