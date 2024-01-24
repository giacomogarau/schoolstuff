/* direttive al preprocessore */
#include <arpa/inet.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <unistd.h>
/* prototipi */
void printHelp();
int main(int argc, char **argv) {
  /* controllo numero parametri */
  if (argc != 3 && argc != 4)
    printHelp();
  char buffer[100];
  bzero(buffer, 100);
  int sockfd = socket(AF_INET, SOCK_STREAM, 0);
  struct sockaddr_in address;
  address.sin_family = AF_INET;
  address.sin_port = htons(2001);
  address.sin_addr.s_addr = inet_addr("127.0.0.1");
  if (connect(sockfd, (struct sockaddr *)&address, sizeof(struct sockaddr)) ==
      -1) {
    perror("errore connect");
    exit(-1);
  }
  switch (argc) {
  case 4:
    sprintf(buffer, "%s %s %s", argv[1], argv[2], argv[3]);
    break;
  case 3:
    sprintf(buffer, "%s %s", argv[1], argv[2]);
    break;
  }
  write(sockfd, buffer, strlen(buffer));
  bzero(buffer, 100);
  read(sockfd, buffer, sizeof(buffer));
  printf("Output: %s\n", buffer);
  close(sockfd);
}

void printHelp() {
  printf("utilizzo: ./client <calcolo> <param1> <param2>\n");
  printf("param2 può non esistere in base al tipo di calcolo\n");
  exit(-1);
}
