/* direttive al preprocessore */
#include <arpa/inet.h>
#include <signal.h>
#include <stdbool.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <unistd.h>

/* prototipi */
void func(int signal);
/* variabili globali */
int sockfd;

int main() {
  /* intercetta SIGINT (ctrl+c) */
  signal(SIGINT, func);
  while (true) {
    /* creazione socket e variabili */
    sockfd = socket(AF_INET, SOCK_STREAM, 0);
    char request[4];
    char param1[50], param2[50];
    char output[50];
    char buffer[100];
    bzero(buffer, 100);
    bzero(request, 4);
    bzero(param2, 50);
    bzero(param1, 50);
    bzero(output, 50);
    if (sockfd == -1) {
      perror("errore socket");
      exit(-1);
    }
    /* struttura indirizzo/porta a cui collegarsi */
    struct sockaddr_in server_addr, client_addr;
    socklen_t client_length;
    server_addr.sin_family = AF_INET;
    server_addr.sin_port = htons(2001);
    server_addr.sin_addr.s_addr = inet_addr("127.0.0.1");
    /* ignora problemi relativi al time_wait */
    int reuse = 1;
    setsockopt(sockfd, 1, SO_REUSEPORT, &reuse, sizeof(int));
    setsockopt(sockfd, 1, SO_REUSEADDR, &reuse, sizeof(int));
    /* occupa la porta */
    if (bind(sockfd, (struct sockaddr *)&server_addr,
             sizeof(struct sockaddr)) == -1) {
      perror("errore bind");
      exit(-2);
    }
    /* imposta il server in ascolto */
    if (listen(sockfd, 1) == -1) {
      perror("errore listen");
      exit(-3);
    }
    /* accetta la connessione, salvando l'indirizzo ip del mittente a mano */
    int newsockfd =
        accept(sockfd, (struct sockaddr *)&client_addr, &client_length);
    read(newsockfd, buffer, sizeof(buffer));
    /* controlla se è stata chiesta un'operazione not */
    if (strncmp(buffer, "NOT", 3) == 0) {
      printf("ricevuta richiesta operazione not\n");
      sscanf(buffer, "%*s %s", param1);
      printf("parametro ricevuto: %s\n", param1);
      for (int i = 0; i < strlen(param1); i++) {
        if (param1[i] == '1')
          output[i] = '0';
        else if (param1[i] == '0')
          output[i] = '1';
        else {
          i = strlen(param1);
          bzero(output, 50);
          strcpy(output, "Operazione non eseguibile");
        }
      }
    }
    /* controlla se è stata chiesta un'operazione and */
    else if (strncmp(buffer, "AND", 3) == 0) {
      printf("ricevuta richiesta operazione and\n");
      sscanf(buffer, "%*s %s %s", param1, param2);
      printf("parametri ricevuti: %s %s\n", param1, param2);
      if (strlen(param1) == strlen(param2)) {
        printf("la lunghezza dei parametri è valida\n");
        for (int i = 0; i < strlen(param1); i++) {
          if ((param1[i] == '1' || param1[i] == '0') &&
              (param2[i] == '1' || param2[i] == '0')) {
            if (param1[i] == '1' && param2[i] == '1')
              output[i] = '1';
            else
              output[i] = '0';
          } else {
            i = strlen(param1);
            bzero(output, 50);
            strcpy(output, "Operazione non eseguibile");
          }
        }
      } else {
        bzero(output, 50);
        strcpy(output, "Operazione non eseguibile");
      }
    }
    /* controlla se è stata chiesta un operazione or */
    else if (strncmp(buffer, "OR", 2) == 0) {
      printf("ricevuta richiesta operazione or\n");
      sscanf(buffer, "%*s %s %s", param1, param2);
      printf("parametri ricevuti: %s %s\n", param1, param2);
      if (strlen(param1) == strlen(param2)) {
        printf("la lunghezza dei parametri è valida\n");
        for (int i = 0; i < strlen(param1); i++) {
          if ((param1[i] == '1' || param1[i] == '0') &&
              (param2[i] == '1' || param2[i] == '0')) {
            if (param1[i] == '1' || param2[i] == '1')
              output[i] = '1';
            else
              output[i] = '0';
          } else {
            i = strlen(param1);
            bzero(output, 50);
            strcpy(output, "Operazione non eseguibile");
          }
        }
      } else {
        bzero(output, 50);
        strcpy(output, "Operazione non eseguibile");
      }
    }
    /* se l'operazione non corrisponde con nessuna di quelle supportate verrà
       mandato un messaggio di errore */
    else
      strcpy(output, "Operazione non eseguibile");
    /* manda il risultato e chiudi la connessione */
    write(newsockfd, output, strlen(output));
    close(newsockfd);
    close(sockfd);
  }
}

void func(int signal) {
  printf("chiusura in corso");
  close(sockfd);
  exit(0);
}
