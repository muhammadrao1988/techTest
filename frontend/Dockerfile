# # Fetching the latest node image on alpine linux
FROM node:alpine AS development

# Declaring env
ENV NODE_ENV development

WORKDIR /app

COPY ./nextjs-app/package*.json ./

# Install dependencies
RUN npm install --no-cache
# Copy the rest of the Next.js application code
COPY react-app/ .

# Expose the port that the Next.js app runs on
EXPOSE 3000

# Define the command to run the Next.js app
CMD ["npm", "run", "dev"]
