#include <unistd.h>
#include <stdio.h>

int main(int argc, char* argv[]) {
    setuid(0);
    char* args[6];
    args[0] = "/usr/bin/indexer";
    args[1] = "--rotate";
    args[2] = "--all";
    args[3] = "-c";
    args[4] = "/etc/sphinx/sphinx.conf";
    args[5] = NULL;
    execv(args[0], args);
    printf("Error executing script!");
    return 1;
}