-- what applications are running under each domain?
SELECT d.name AS domain, s.display_name AS server, ee.path, a.name AS application, e.name AS endpoint
FROM domains d
JOIN ip_addresses i ON d.ip_address_id = i.id
JOIN servers s ON i.server_id = s.id
LEFT JOIN environment_endpoints ee ON d.id = ee.domain_id
LEFT JOIN endpoints e ON ee.endpoint_id = e.id
LEFT JOIN applications a ON e.application_id = a.id
ORDER BY domain, ee.path, server
