CREATE TABLE t_match (
     match_id           VARCHAR(15)
    ,data_version       VARCHAR(5)
    ,game_datetime      BIGINT
    ,game_length        FLOAT
    ,game_version       VARCHAR(150)
    ,queue_id           INT
    ,tft_game_type      VARCHAR(20)
    ,tft_set_core_name  VARCHAR(20)
    ,tft_set_number     INT
)