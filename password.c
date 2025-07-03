
// Function to test for numeric ch#include<stdio.h>
#include<string.h>
#include<ctype.h>
#include<ctype.h>
#include<stdio.h>

// Function prototypes for the declared functions
int check_password(char *password);
int test_password_length(char *password, int min);
int test_password_uppercase_characters(char *password); 
int test_password_lowercase_characters(char *password);
int test_password_numeric_characters(char *password);
int test_password_special_characters(char *password);
int test_password_repeats(char *password);


// Function to check the password strength based on various criteria
// Returns a score based on the criteria met

int check_password(char *password) {
    int score =0;
    score += test_password_length(password, 8 );
    score += test_password_lowercase_characters(password);
    score += test_password_uppercase_characters(password);
    score += test_password_numeric_characters(password);
    score += test_password_special_characters(password);
    score += test_password_repeats(password);

    return score;
}
 // Function to test the password length
// Returns 1 if the length is sufficient, otherwise returns 0
int test_password_length(char *password, int min ) {
    if(strlen(password) < min) {
        return 0; // Password length is insufficient
    } else {
        return 1; // Password length is sufficient
    }

}
// Function to test for uppercase characters in the password
// Returns 2 if at least one uppercase character is found, otherwise returns 0
int test_password_uppercase_characters(char *password) {
    for(int i = 0; i < strlen(password); i++) {
        if(isupper(password[i])) {
            return 2; // At least one uppercase character found
        }
    }
    return 0; // No uppercase character found
}
// Function to test for lowercase characters in the password
// Returns 2 if at least three lowercase characters are found, otherwise returns 0
int test_password_lowercase_characters(char *password) {
    int count = 0;
    for(int i = 0; i < strlen(password); i++) {
        if(islower(password[i])) {
            count++;
        }
        if(count >= 3) {
            return 2; // At least three lowercase characters found
        }
    }
    return 0;
 } // No lowercase characters in the password
// Returns 2 if at least two numeric characters are found, otherwise returns 0
int test_password_numeric_characters(char *password) {
    int count = 0;
    for(int i = 0; i < strlen(password); i++) {
        if(isdigit(password[i])) {
            count++;
        }
        if(count >= 2) {
            return 2; // At least two numeric characters found
        }
    }
    return 0; // No numeric character found
}
// Function to test for special characters in the password
// Returns 2 if at least one special character is found, otherwise returns 0
int test_password_special_characters(char *password) {
    int count = 0;
    for(int i = 0; i < strlen(password); i++) {
        if(ispunct(password[i])) {
            count++;
        }
        if(count >= 1) {
            return 2; // At least one special character found
        }
    }
    return 0; // No special character found
}
// Function to test for repeated characters in the password
// Returns 0 if repeated characters are found, otherwise returns 2
int test_password_repeats(char *password) {
    int count = 0;
    for(int i = 0; i < strlen(password) - 1; i++) {
        if(password[i] == password[i + 1]) {
            count++;
        }
    }
    if(count > 0) {
        return 0; // Repeated characters found
    } else {
        return 2; // No repeated characters found
    }
}
int main(int argc, char *argv[]) {
    if (argc != 2) {
        printf("0\n");
        return 1;
    }

    int score = check_password(argv[1]);
    printf("%d\n", score);  // Only print the score
    return 0;
}