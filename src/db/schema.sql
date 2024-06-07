DROP TABLE IF EXISTS fighter;
DROP TABLE IF EXISTS fights;

CREATE TABLE fighter (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    first_name VARCHAR NOT NULL,
    last_name VARCHAR NOT NULL,
    record VARCHAR NOT NULL,
    height_in_inches INTEGER NOT NULL,
    weight_in_pounds INTEGER NOT NULL,
    reach_in_inches INTEGER NOT NULL,
    stance VARCHAR NOT NULL,
    birthdate TEXT NOT NULL, /* DATE: YYYY-MM-DD HH:MM:SS.SSS */
    strikes_landed_per_minute REAL NOT NULL,
    striking_accuracy REAL NOT NULL,
    strikes_absorbed_per_minute REAL NOT NULL,
    opponent_strikes_missed REAL NOT NULL,
    average_takedowns_per_quarter_hour REAL NOT NULL,
    takedown_accuracy REAL NOT NULL,
    takedown_defence REAL NOT NULL,
    average_submissions_attempted_per_quarter_hour REAL NOT NULL,
    fight_id INTEGER NOT NULL
);

CREATE TABLE fight (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    fighter_one_id INTEGER NOT NULL,
    fighter_two_id INTEGER NOT NULL,
    winner INTEGER NOT NULL,
    fighter_one_knockdowns INTEGER NOT NULL,
    fighter_one_strikes INTEGER NOT NULL,
    fighter_one_takedowns INTEGER NOT NULL,
    fighter_one_submission_attempts INTEGER NOT NULL,
    fighter_two_knockdowns INTEGER NOT NULL,
    fighter_two_strikes INTEGER NOT NULL,
    fighter_two_takedowns INTEGER NOT NULL,
    fighter_two_submission_attempts INTEGER NOT NULL,
    ufc_event VARCHAR NOT NULL,
    result_method VARCHAR NOT NULL,
    last_round INTEGER NOT NULL,
    ending_time VARCHAR NOT NULL,

    FOREIGN KEY (fighter_one_id) REFERENCES fighter (id),
    FOREIGN KEY (fighter_two_id) REFERENCES fighter (id)
);
