-- what IP addresses are running on what servers, and what are they used for?
SELECT s.display_name AS server, i.public_address AS ip, d.name AS domain
FROM servers s
JOIN ip_addresses i ON i.server_id = s.id
JOIN domains d ON d.ip_address_id = i.id
ORDER BY server;