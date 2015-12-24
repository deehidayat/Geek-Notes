Any usable command 

---

## Linux
- Search package on current repository
`eg: sudo apt-cache search opengeo`

- Login as another user
`sudo su postges`

- (Setup Postgres user for the first time)[http://suite.opengeo.org/opengeo-docs/dataadmin/pgGettingStarted/firstconnect.html#dataadmin-pggettingstarted-firstconnect]

- [Update GRUB](http://www.howtogeek.com/196655/how-to-configure-the-grub2-boot-loaders-settings/)

- Run file backgorund
`nohup sudo root-0.1-SNAPSHOT/bin/root -Dhttp.port=8080 &`

- Lists listened port
`sudo netstat -tulpn`

- Kill listened port
`fuser -k 8080/tcp`

- Update GRUB File
`sudo update-grub`

- Open port
`sudo ufw allow 8081/tcp`

- Close port
`sudo ufw disallow 8081/tcp`

- [Set Network Interface on Ubuntu 14.04](https://sites.cns.utexas.edu/oit-blog/blog/how-set-static-ip-linux-machine)

## PHP
Installing module and enable it manually
eg: sudo apt-get install php5-mcrypt && sudo php5enmod mcrypt

