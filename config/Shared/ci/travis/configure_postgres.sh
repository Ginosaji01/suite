#!/bin/bash

# Set poor access to the Postgres for Travis testing needs
sudo sed -ie 's/md5/trust/g' /etc/postgresql/12/main/pg_hba.conf
sudo sed -ie 's/peer/trust/g' /etc/postgresql/12/main/pg_hba.conf

# Restart Postgres service
sudo pg_ctlcluster --skip-systemctl-redirect 12 main restart
