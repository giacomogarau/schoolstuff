#include <pthread.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <sys/mman.h>
#include <unistd.h>
int *v;
void *mio_thread1();
void *mio_thread2();
int main(int argc, char *argv[]) {
  /* Controllo parametri */
  if (argc != 2) {
    printf("Utilizzo: %s <stringa da stampare>\n", argv[0]);

    return -1;
  }
  /* Dichiarazione variabili */
  pthread_t th1, th2;
  v = (int *)mmap(NULL, 6, PROT_READ | PROT_WRITE, MAP_ANON | MAP_SHARED, -1,
                  0);
  *v = 1;
  /* Crea i 2 Thread distinti */
  pthread_create(&th1, NULL, mio_thread1, argv[1]);
  pthread_create(&th2, NULL, mio_thread2, argv[1]);
  /* Aspetta il termine dei 2 Thread */
  pthread_join(th1, NULL);
  pthread_join(th2, NULL);
  printf("\n");
  return 0;
}

void *mio_thread1(char *arg) {
  int len = strlen(arg);
  int i = 0;
  while (i < len) {
    while (*v != 1)
      ; // Blocca il primo thread se ha il semaforo rosso
    printf("%c", arg[i]);
    fflush(stdout);
    sleep(1);
    *v = 2; // Semaforo rosso per il primo thread e semaforo verde per il
            // secondo thread
    i = i + 2;
  }
}

void *mio_thread2(char *arg) {
  int len = strlen(arg);
  int i = 1;
  while (i < len) {
    while (*v != 2)
      ; // Blocca il primo thread se ha il semaforo rosso
    printf("%c", arg[i]);
    fflush(stdout);
    sleep(1);
    *v = 1; // Semaforo rosso per il primo thread e semaforo verde per il
            // secondo thread
    i = i + 2;
  }
}
