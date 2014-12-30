-- where is each application deployed?
SELECT a.name AS application, e.name AS endpoint, d.name AS domain, s.display_name AS server, ee.path
FROM applications a
JOIN endpoints e ON e.application_id = a.id
JOIN environment_endpoints ee ON e.id = ee.endpoint_id
JOIN domains d ON ee.domain_id = d.id
JOIN ip_addresses i ON d.ip_address_id = i.id
JOIN servers s ON i.server_id = s.id
ORDER BY application, endpoint, domain, server, path;
