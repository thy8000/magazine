const { withFaust, getWpHostname } = require("@faustwp/core");

/**
 * @type {import('next').NextConfig}
 **/
module.exports = withFaust({
  images: {
    remotePatterns: [
      {
        protocol: "http",
        hostname: "localhost",
      },
    ],
  },
});
