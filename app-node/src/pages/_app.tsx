import "../../faust.config";
import React from "react";
import { useRouter } from "next/router";
import { FaustProvider } from "@faustwp/core";
import { AppProps } from "next/app";

import "../assets/css/_index.css";

export default function MyApp({ Component, pageProps }: AppProps) {
  const router = useRouter();

  return (
    <FaustProvider pageProps={pageProps}>
      <Component {...pageProps} key={router.asPath} />
    </FaustProvider>
  );
}
