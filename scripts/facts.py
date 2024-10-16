import random
import sys
import json

file = sys.argv[1] 
num_of_facts = int(sys.argv[2]) 

def generate_facts(file, num_of_facts):
    facts_file = file
    facts: list[str] = []
    
    with open(facts_file, 'r') as f:

        facts = [line.strip() for line in f if line.strip() != ""]
        # print(facts)
        
            
    random_facts: list[str] = random.sample(facts, num_of_facts)
    random_facts = json.dumps(random_facts)
            
    return random_facts

if __name__ == "__main__":
    generated_facts = generate_facts(file, num_of_facts)
    print(generated_facts)