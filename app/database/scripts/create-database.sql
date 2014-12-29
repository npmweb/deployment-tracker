-- edit to specify your own DB name, etc
CREATE DATABASE l_DeploymentTracker;

GRANT ALL PRIVILEGES
  ON l_DeploymentTracker.*
  TO 'l_DeploymentTracker'@'localhost'
  IDENTIFIED BY 'l_DeploymentTracker'
  WITH GRANT OPTION;
