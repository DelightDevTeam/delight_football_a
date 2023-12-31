SELECT * FROM football.odds
WHERE status = 1
AND money_line_h > 0
AND money_line_a > 0
AND spreads_h > 0
AND spreads_a > 0
AND totals_point > 0
ORDER BY starts, league_name;
